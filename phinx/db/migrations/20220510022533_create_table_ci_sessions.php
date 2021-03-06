<?php

declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class CreateTableCiSessions extends AbstractMigration
{
    /**
     * Change Method.
     *
     * Write your reversible migrations using this method.
     *
     * More information on writing migrations is available here:
     * https://book.cakephp.org/phinx/0/en/migrations.html#the-change-method
     *
     * Remember to call "create()" or "update()" and NOT "save()" when working
     * with the Table class.
     */
    public function change(): void
    {
        $table = $this->table('ci_sessions', ['id' => false]);
        $table
            ->addColumn('id', 'string', ['limit' => 128, 'null' => false])
            ->addColumn('ip_address', 'inet', ['null' => false])
            ->addColumn(
                'timestamp',
                'timestamp',
                ['timezone' => true, 'default' => 'CURRENT_TIMESTAMP', 'null' => false]
            )
            ->addColumn('data', 'binary', ['default' => '', 'null' => false])
            ->addIndex('timestamp')
            ->create();
    }
}
