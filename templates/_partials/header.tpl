{**
 * 2007-2017 PrestaShop
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Academic Free License 3.0 (AFL-3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * https://opensource.org/licenses/AFL-3.0
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
 * @author    PrestaShop SA <contact@prestashop.com>
 * @copyright 2007-2017 PrestaShop SA
 * @license   https://opensource.org/licenses/AFL-3.0 Academic Free License 3.0 (AFL-3.0)
 * International Registered Trademark & Property of PrestaShop SA
 *}
{block name='header_banner'}
  {capture name="displayBanner"}{hook h="displayBanner"}{/capture}
  {if $smarty.capture.displayBanner}
    <div id="displayBanner" class="header-banner">{$smarty.capture.displayBanner nofilter}</div>
  {/if}
{/block}

{block name='header_top'}
  {capture name="displayNav1"}{hook h="displayNav1"}{/capture}
  {capture name="displayNav2"}{hook h="displayNav2"}{/capture}
  {capture name="displayNav3"}{hook h="displayNav3"}{/capture}
  {*{if $smarty.capture.displayNav1 || $smarty.capture.displayNav2 || $smarty.capture.displayNav3}*}
    <div class="header-top py-1">
      <div class="container-fluid">
	    <div class="row">
	      {*{if $smarty.capture.displayNav1}*}
	        <nav id="nav_right" class="col">{$smarty.capture.displayNav1 nofilter}</nav>
	      {*{/if}*}
	      {*{if $smarty.capture.displayNav2}*}
	        <nav id="nav_center" class="col">{$smarty.capture.displayNav2 nofilter}</nav>
	      {*{/if}*}
	      {*{if $smarty.capture.displayNav3}*}
	        <nav id="nav_left" class="col">{$smarty.capture.displayNav3 nofilter}</nav>
	      {*{/if}*}
	    </div>
	  </div>
    </div>
  {*{/if}*}
{/block}

{block name='header_center'}
  <div class="header-center py-3">
    <div class="container-fluid">
	  <div class="row">
	    <div class="col">
		  {hook h="displayNav1"}
		</div>
	    <div class="col">{hook h="displayNav2"}</div>
	    <div class="col">
		  <div id="logo" class="d-flex justify-content-end">
		    <a class="align-self-center" href="{$urls.base_url}" title="{$shop.name}">
			  <img src="{$shop.logo}" alt="{$shop.name}">
			</a>
		  </div>
		</div>
	  </div>
	</div>
  </div>
{/block}

{block name='header_bottom'}
  {capture name='displayMainMenu'}{hook h='displayMainMenu'}{/capture}
  {*{if $smarty.capture.displayMainMenu}*}
    <div class="header-bottom py-1">
      <div class="container-fluid">{$smarty.capture.displayMainMenu nofilter}</div>
    </div>
  {*{/if}*}
  {hook h='displayNavFullWidth'}
{/block}
