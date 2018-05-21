<?php
namespace Martijn\Blog\Setup;

use Magento\Framework\Setup\InstallSchemaInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use magento\Framework\DB\Ddl\Table;
use Magento\Framework\DB\Adapter\AdapterInterface;
use Magento\Framework\Setup\SchemaSetupInterface;

/**
 * Class InstallSchema
 * @package Martijn\Blog\Setup
 */
class InstallSchema implements InstallSchemaInterface
{
    /**
     * @param SchemaSetupInterface $setup
     * @param ModuleContextInterface $context
     * @throws \Zend_Db_Exception
     */
    public function install(SchemaSetupInterface $setup, ModuleContextInterface $context)
    {
        $installer = $setup;
        $installer->startSetup();
        if (!$installer->tableExists('martijn_blog')) {
            $table = $installer->getConnection()->newTable(
            $installer->getTable('martijn_blog')
        )
            ->addColumn(
                'id',
                Table::TYPE_INTEGER,
                null,
                [
                    'identity'       => true,
                    'nullable'       => false,
                    'primary'        => true,
                    'unsigned'       => true,
                    'auto_increment' => true,
                ],
                'id'
            )
                ->addColumn(
                    'title',
                    Table::TYPE_TEXT,
                    100,
                    ['nullable' => false,],
                    'title'
            )
                ->addColumn(
                    'content',
                    Table::TYPE_TEXT,
                    1000,
                    ['nullable' => false,],
                    'content'
            )
                ->addColumn(
                    'posted_by',
                    Table::TYPE_TEXT,
                    11,
                    [],
                    'Posted by'
            )
                ->addColumn(
                    'date',
                    Table::TYPE_TIMESTAMP,
                    null,
                    [
                        'nullable' => false,
                        'default' => Table::TIMESTAMP_INIT
                    ],
                    'date'
            );

            $installer->getConnection()->createTable($table);

            $installer->getConnection()->addIndex(
                $installer->getTable('martijn_blog'),
                $setup->getIdxName(
                    $installer->getTable('martijn_blog'),
                ['title', 'content', 'posted_by'],
                AdapterInterface::INDEX_TYPE_FULLTEXT
            ),
                ['title', 'content', 'posted_by'],
                AdapterInterface::INDEX_TYPE_FULLTEXT
            );
        }
        $installer->endSetup();
    }
}