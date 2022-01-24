<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */

namespace Custom\Product\Plugin\Product;

use Magento\Catalog\Model\Product;

class ProductAttributesUpdater
{

    private $productHelper;

    public function __construct(Data $productHelper)
    {
        $this->productHelper = $productHelper;
    }

	/**
     * Update product name with prefix
     *
     * @return string
     * @codeCoverageIgnoreStart
     */
    public function afterGetName(Product $subject, $result)
    {
        return 'See Possible' . $result;
    }
}