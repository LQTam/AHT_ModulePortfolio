<?php

namespace AHT\Portfolio\Setup;

use Magento\Framework\Setup\InstallSchemaInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\SchemaSetupInterface;

class InstallSchema implements InstallSchemaInterface
{
    public function install(SchemaSetupInterface $setup, ModuleContextInterface $context)
    {
        $installer = $setup;

        $installer->startSetup();

        $catagoryTable = $installer->getConnection()
            ->newTable($installer->getTable('aht_categories'))
            ->addColumn(
                'category_id',
                \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
                null,
                ['identity' => true, 'unsigned' => true, 'nullable' => false, 'primary' => true],
                'Category Id'
            )
            ->addColumn('name', \Magento\Framework\DB\Ddl\Table::TYPE_TEXT, 256, ['nullable' => false], 'Category Name');
        $installer->getConnection()->createTable($catagoryTable);


        $portfolioTable = $installer->getConnection()
            ->newTable($installer->getTable('aht_portfolio'))
            ->addColumn(
                'portfolio_id',
                \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
                null,
                ['identity' => true, 'unsigned' => true, 'nullable' => false, 'primary' => true],
                'Portfolio Id'
            )
            ->addColumn(
                'category_id',
                \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
                null,
                ['nullable' => false, 'unsigned' => true,],
                'Category Id'
            )
            ->addColumn('client', \Magento\Framework\DB\Ddl\Table::TYPE_TEXT, 256, ['nullable' => false], 'Portfolio Client')
            ->addColumn('project', \Magento\Framework\DB\Ddl\Table::TYPE_TEXT, 256, ['nullable' => false], 'Portfolio Project')
            ->addColumn('skill', \Magento\Framework\DB\Ddl\Table::TYPE_TEXT, 256, ['nullable' => false], 'Portfolio Skill')
            ->addColumn('status', \Magento\Framework\DB\Ddl\Table::TYPE_SMALLINT, null, ['nullable' => false], 'Portfolio Status')
            ->addColumn('content', \Magento\Framework\DB\Ddl\Table::TYPE_TEXT, '64k', ['nullable' => false], 'Portfolio Content')

            ->addIndex($installer->getIdxName('aht_portfolio', ['category_id']), ['category_id'])
            ->addForeignKey(
                $installer->getFkName('aht_portfolio', 'category_id', 'aht_categories', 'category_id'),
                'category_id',
                $installer->getTable('aht_categories'),
                'category_id',
                \Magento\Framework\DB\Ddl\Table::ACTION_CASCADE
            );

        $installer->getConnection()->createTable($portfolioTable);

        $imageTable = $installer->getConnection()
            ->newTable($installer->getTable('aht_images'))
            ->addColumn(
                'image_id',
                \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
                null,
                ['identity' => true, 'unsigned' => true, 'nullable' => false, 'primary' => true],
                'Image Id'
            )
            ->addColumn(
                'portfolio_id',
                \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
                null,
                ['nullable' => false, 'unsigned' => true,],
                'Portfolio Foreign_Key Id'
            )
            ->addColumn('thumbnail', \Magento\Framework\DB\Ddl\Table::TYPE_TEXT, 256, ['nullable' => false], 'Image Thumbnail')
            ->addColumn('name', \Magento\Framework\DB\Ddl\Table::TYPE_TEXT, 256, ['nullable' => false], 'Image Name')
            ->addColumn('alt', \Magento\Framework\DB\Ddl\Table::TYPE_TEXT, 256, ['nullable' => true], 'Image Alt')
            ->addColumn('src', \Magento\Framework\DB\Ddl\Table::TYPE_TEXT, 256, ['nullable' => false], 'Image Src')
            ->addColumn('width', \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER, null, ['nullable' => true], 'Image Width')
            ->addColumn('height', \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER, null, ['nullable' => true], 'Image Height')
            ->addIndex($installer->getIdxName('aht_images', ['portfolio_id']), ['portfolio_id'])
            ->addForeignKey(
                $installer->getFkName('aht_images', 'portfolio_id', 'aht_portfolio', 'portfolio_id'),
                'portfolio_id',
                $installer->getTable('aht_portfolio'),
                'portfolio_id',
                \Magento\Framework\DB\Ddl\Table::ACTION_CASCADE
            );

        $installer->getConnection()->createTable($imageTable);
        $installer->getConnection()->addIndex(
            $installer->getTable('aht_portfolio'),
            $installer->getIdxName(
                $installer->getTable('aht_portfolio'),
                ['client', 'skill', 'content',  'project'],
                \Magento\Framework\DB\Adapter\AdapterInterface::INDEX_TYPE_FULLTEXT
            ),
            ['client', 'skill', 'content', 'project'],
            \Magento\Framework\DB\Adapter\AdapterInterface::INDEX_TYPE_FULLTEXT
        );
        $installer->getConnection()->addIndex(
            $installer->getTable('aht_categories'),
            $installer->getIdxName(
                $installer->getTable('aht_categories'),
                ['name'],
                \Magento\Framework\DB\Adapter\AdapterInterface::INDEX_TYPE_FULLTEXT
            ),
            ['name'],
            \Magento\Framework\DB\Adapter\AdapterInterface::INDEX_TYPE_FULLTEXT
        );


        $installer->endSetup();
    }
}
