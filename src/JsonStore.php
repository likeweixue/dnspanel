<?php

declare(strict_types=1);

final class JsonStore
{
    public function __construct(private string $directory)
    {
        if (!is_dir($this->directory)) {
            throw new RuntimeException('Storage directory is missing.');
        }
    }

    public function read(string $file, string $collection): array
    {
        $lock = $this->acquireLock(LOCK_SH);

        try {
            return $this->readDocument($file, $collection);
        } finally {
            $this->releaseLock($lock);
        }
    }

    /**
     * $files 使用“文件名 => 集合名”的格式，回调接收并可直接修改全部文档。
     */
    public function transaction(array $files, callable $callback): mixed
    {
        $lock = $this->acquireLock(LOCK_EX);

        try {
            $documents = [];
            foreach ($files as $file => $collection) {
                $documents[$file] = $this->readDocument($file, $collection);
            }

            $result = $callback($documents);

            foreach ($documents as $file => $document) {
                $this->writeDocument($file, $document);
            }

            return $result;
        } finally {
            $this->releaseLock($lock);
        }
    }

    private function readDocument(string $file, string $collection): array
    {
        $path = $this->path($file);
        if (!is_file($path)) {
            throw new RuntimeException('Storage file is missing.');
        }

        $json = file_get_contents($path);
        if ($json === false) {
            throw new RuntimeException('Storage file cannot be read.');
        }

        try {
            $document = json_decode($json, true, 512, JSON_THROW_ON_ERROR);
        } catch (JsonException $exception) {
            throw new RuntimeException('Storage data is invalid.', 0, $exception);
        }

        if (
            !is_array($document)
            || ($document['version'] ?? null) !== 1
            || !isset($document[$collection])
            || !is_array($document[$collection])
        ) {
            throw new RuntimeException('Storage structure is invalid.');
        }

        return $document;
    }

    private function writeDocument(string $file, array $document): void
    {
        $path = $this->path($file);
        $temporary = tempnam($this->directory, '.tmp_');
        if ($temporary === false) {
            throw new RuntimeException('Temporary storage file cannot be created.');
        }

        $handle = null;

        try {
            $json = json_encode($document, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_THROW_ON_ERROR) . "\n";
            $handle = fopen($temporary, 'wb');
            if ($handle === false) {
                throw new RuntimeException('Temporary storage file cannot be opened.');
            }

            $remaining = strlen($json);
            $offset = 0;
            while ($remaining > 0) {
                $written = fwrite($handle, substr($json, $offset));
                if ($written === false || $written === 0) {
                    throw new RuntimeException('Storage data cannot be written.');
                }
                $offset += $written;
                $remaining -= $written;
            }

            if (!fflush($handle)) {
                throw new RuntimeException('Storage data cannot be flushed.');
            }
            if (function_exists('fsync') && !fsync($handle)) {
                throw new RuntimeException('Storage data cannot be synchronized.');
            }

            fclose($handle);
            $handle = null;
            chmod($temporary, 0660);

            if (!rename($temporary, $path)) {
                throw new RuntimeException('Storage data cannot be replaced.');
            }
        } finally {
            if (is_resource($handle)) {
                fclose($handle);
            }
            if (is_file($temporary)) {
                unlink($temporary);
            }
        }
    }

    private function path(string $file): string
    {
        if (!in_array($file, ['users.json', 'domains.json', 'requests.json'], true)) {
            throw new InvalidArgumentException('Unknown storage file.');
        }

        return $this->directory . DIRECTORY_SEPARATOR . $file;
    }

    /** @return resource */
    private function acquireLock(int $operation)
    {
        $handle = fopen($this->directory . DIRECTORY_SEPARATOR . 'app.lock', 'c+b');
        if ($handle === false || !flock($handle, $operation)) {
            if (is_resource($handle)) {
                fclose($handle);
            }
            throw new RuntimeException('Storage lock cannot be acquired.');
        }

        return $handle;
    }

    /** @param resource $handle */
    private function releaseLock($handle): void
    {
        flock($handle, LOCK_UN);
        fclose($handle);
    }
}
