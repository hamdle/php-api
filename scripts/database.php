<?php

$commands = [
    'schema' => 'ReloadDatabaseSchema',
    'data' => 'ImportTestData',
    'reload' => 'ReloadAndImport'
];

class DatabaseCommand
{
    private $db_name = 'wo_db';
    private $db_user = 'root';
    private $db_pass = 'root';
    private $db_schema = '../docs/db/schema.sql';
    private $db_data = '../docs/db/testdata.sql';

    public function reloadSchema()
    {
        return "mysql -u {$this->db_user} -p{$this->db_pass} --database {$this->db_name} < {$this->db_schema}";
    }

    public function importData()
    {
        return "mysql -u {$this->db_user} -p{$this->db_pass} --database {$this->db_name} < {$this->db_data}";
    }
}

foreach ($argv as $value)
{
    if (array_key_exists($value, $commands))
    {
        $commands[$value]();
    } 
}

function ReloadDatabaseSchema()
{
    echo "Reloading database...\n";
    $dbCmd = new DatabaseCommand();
    exec($dbCmd->reloadSchema());
    echo "Done.\n";
}

function ImportTestData()
{
    echo "Importing test data...\n";
    $dbCmd = new DatabaseCommand();
    exec($dbCmd->importData());
    echo "Done.\n";
}

function ReloadAndImport()
{
    ReloadDatabaseSchema();
    ImportTestData();
}
