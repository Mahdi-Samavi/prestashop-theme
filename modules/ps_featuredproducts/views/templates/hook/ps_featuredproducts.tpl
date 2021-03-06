{*
* 2007-2016 PrestaShop
*
* NOTICE OF LICENSE
*
* This source file is subject to the Academic Free License (AFL 3.0)
* that is bundled with this package in the file LICENSE.txt.
* It is also available through the world-wide-web at this URL:
* http://opensource.org/licenses/afl-3.0.php
* If you did not receive a copy of the license and are unable to
* obtain it through the world-wide-web, please send an email
* to license@prestashop.com so we can send you a copy immediately.
*
* DISCLAIMER
*
* Do not edit or add to this file if you wish to upgrade PrestaShop to newer
* versions in the future. If you wish to customize PrestaShop for your
* needs please refer to http://www.prestashop.com for more information.
*
*  @author PrestaShop SA <contact@prestashop.com>
*  @copyright  2007-2016 PrestaShop SA
*  @license    http://opensource.org/licenses/afl-3.0.php  Academic Free License (AFL 3.0)
*  International Registered Trademark & Property of PrestaShop SA
*}

<section class="container-fluid">
  <h1>{l s='Our Products' d='Modules.Featuredproducts.Shop'}</h1>
  <div class="products-container">
    {foreach from=$products item="product"}
	  <div class="col-lg-3">
	    {include file="catalog/_partials/miniatures/product.tpl" product=$product}
	  </div>
    {/foreach}
  </div>
  <div>
    <a id="more-products" class="btn" href="{$allProductsLink}">{l s='All products' d='Modules.Featuredproducts.Shop'}</a>
  </div>
</section>
