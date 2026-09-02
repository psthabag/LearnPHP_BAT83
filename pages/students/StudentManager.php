<?php
// StudentManager.php

class StudentManager {
    private string $filePath;
    private string $delimiter = "||"; // Unique separator to avoid conflict with spaces or commas

    public function __construct(string $filePath) {
        $this->filePath = $filePath;
        
        // Automatically create the text file if it does not exist yet
        if (!file_exists($this->filePath)) {
            file_put_contents($this->filePath, ""); 
        }
    }

    /**
     * Appends a new student record to the text file.
     */
    public function addStudent(string $id, string $name, int $age, string $phone): bool {
        // Sanitize string data to remove hidden line breaks or malicious HTML tags
        $id = str_replace([PHP_EOL, $this->delimiter], '', strip_tags(trim($id)));
        $name = str_replace([PHP_EOL, $this->delimiter], '', strip_tags(trim($name)));
        $phone = str_replace([PHP_EOL, $this->delimiter], '', strip_tags(trim($phone)));

        // Construct the text row line
        $line = $id . $this->delimiter . $name . $this->delimiter . $age . $this->delimiter . $phone . PHP_EOL;

        // Use SplFileObject in append mode to cleanly write data
        try {
            $file = new SplFileObject($this->filePath, 'a');
            $file->fwrite($line);
            return true;
        } catch (Exception $e) {
            return false;
        }
    }

    /**
     * Reads the file and returns an associative array of all students.
     */
    public function getAllStudents(): array {
        $studentsList = [];

        try {
            $file = new SplFileObject($this->filePath, 'r');
            
            // Loop through the file line by line
            while (!$file->eof()) {
                $line = trim($file->fgets());
                
                if (empty($line)) {
                    continue; // Skip empty trailing lines
                }

                // Split string data back into independent variables
                $parts = explode($this->delimiter, $line);
                
                // Ensure the row has exactly 4 columns before displaying
                if (count($parts) === 4) {
                    $studentsList[] = [
                        'id'    => $parts[0],
                        'name'  => $parts[1],
                        'age'   => (int)$parts[2],
                        'phone' => $parts[3]
                    ];
                }
            }
        } catch (Exception $e) {
            // If file reading fails, fail gracefully with an empty list
            return [];
        }

        return $studentsList;
    }
}
