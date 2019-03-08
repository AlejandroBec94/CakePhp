<?php
use Migrations\AbstractMigration;

class Initial extends AbstractMigration
{
    public function up()
    {

        $this->table('users')
            ->addColumn('email', 'string', [
                'default' => 'Sin Informacion',
                'limit' => 255,
                'null' => true,
            ])
            ->addColumn('password', 'string', [
                'default' => '0',
                'limit' => 255,
                'null' => true,
            ])
            ->addColumn('phone', 'string', [
                'default' => 'Sin Informacion',
                'limit' => 255,
                'null' => true,
            ])
            ->addColumn('creared', 'datetime', [
                'default' => null,
                'limit' => null,
                'null' => false,
            ])
            ->addColumn('modified', 'datetime', [
                'default' => null,
                'limit' => null,
                'null' => false,
            ])
            ->addIndex(
                [
                    'email',
                ],
                ['unique' => true]
            )
            ->create();
    }

    public function down()
    {
        $this->table('users')->drop()->save();
    }
}
