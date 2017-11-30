<?php

namespace PragmaRX\Yaml\Package\Support;

use Illuminate\Support\Collection;
use PragmaRX\Yaml\Package\Exceptions\InvalidYamlFile;
use Symfony\Component\Yaml\Yaml as SymfonyYaml;

trait Parser
{
    /**
     * Dump array to yaml.
     *
     * @param $input
     * @param int $inline
     * @param int $indent
     * @param int $flags
     *
     * @return string
     */
    public function dump($input, $inline = 5, $indent = 4, $flags = 0)
    {
        return SymfonyYaml::dump($input, $inline, $indent, $flags);
    }

    /**
     * Check if the file is a yaml file.
     *
     * @param $item
     *
     * @return bool
     */
    protected function isYamlFile($item)
    {
        return
            $this->isFile($item) && (
                ends_with(strtolower($item), '.yml') ||
                ends_with(strtolower($item), '.yaml')
            );
    }

    /**
     * Parse a yaml file.
     *
     * @param $contents
     *
     * @throws InvalidYamlFile
     *
     * @return mixed
     */
    public function parse($contents)
    {
        return $this->checkYaml(
            SymfonyYaml::parse($contents)
        );
    }

    /**
     * Check parsed contents.
     *
     * @param $contents
     * @return array
     * @throws InvalidYamlFile
     */
    public function checkYaml($contents)
    {
        if (is_string($contents)) {
            throw new InvalidYamlFile();
        }

        return $contents;
    }

    /**
     * Parses a YAML file into a PHP value.
     *
     * @param string $filename The path to the YAML file to be parsed
     * @param int    $flags    A bit field of PARSE_* constants to customize the YAML parser behavior
     *
     * @return mixed The YAML converted to a PHP value
     *
     * @throws \PragmaRX\Yaml\Package\Exceptions\InvalidYamlFile If the file could not be read or the YAML is not valid
     */
    public function parseFile($filename, $flags = 0)
    {
        return $this->checkYaml(
            SymfonyYaml::parseFile($filename, $flags)
        );
    }

    /**
     * Convert array to yaml and save.
     *
     * @param $array array
     * @param $file string
     */
    public function saveAsYaml($array, $file)
    {
        $array = $array instanceof Collection
            ? $array->toArray()
            : (array) $array;

        file_put_contents($file, SymfonyYaml::dump($array));
    }
}