<?php
/**
 * Custom_Table
 */
declare(strict_types=1);

namespace Custom\Database\Setup\Patch\Data;

use Magento\Framework\Setup\Patch\DataPatchInterface;
use Magento\Framework\Setup\ModuleDataSetupInterface;
/**
 * Class NonRevertable
 * @package BDC\Database\Setup\Patch\Data
 */
class NonRevertable implements DataPatchInterface{
    /**
     * @var ModuleDataSetupInterface $moduleDataSetup
     */
    private $moduleDataSetup;
    /**
     * @param ModuleDataSetupInterface $moduleDataSetup
     */
    public function __construct(ModuleDataSetupInterface $moduleDataSetup){
        $this->moduleDataSetup = $moduleDataSetup;
    }
    /**
     * Do Upgrade
     * @return void
     */
    public function apply(){
        
        $table = "sp_blogs";

        $blogRecord = [
            [
                'title' => 'Blog title 1',
                'description' => "<p>Blog 1 content goes here.</p>\r\n",
                'is_active' => 1
            ],
            [
                'title' => 'Blog title 2',
                'description' => "<p>Blog 2 content goes here.</p>\r\n",
                'is_active' => 1
            ],
            [
                'title' => 'Blog title 3',
                'description' => "<p>Blog 3 content goes here.</p>\r\n",
                'is_active' => 1
            ],
            [
                'title' => 'Blog title 4',
                'description' => "<p>Blog 4 content goes here.</p>\r\n",
                'is_active' => 0
            ],
            [
                'title' => 'Blog title 5',
                'description' => "<p>Blog 5 content goes here.</p>\r\n",
                'is_active' => 0
            ],
            
        ];
        foreach ($blogRecord as $data) {
            $this->moduleDataSetup->getConnection()->insert($table, $data);
        }
    }
    /**
     * {@inheritdoc}
     */
    public function getAliases(){
        return [];
    }
    /**
     * {@inheritdoc}
     */
    public static function getDependencies(){
        return [];
    }
}
