{assign var="symbol" value=$theme.pro_bck_truncated_text|default:'...'}
{block name='product_miniature_item'}
  <article class="product-miniature" data-id-product="{$product.id_product}" data-id-product-attribute="{$product.id_product_attribute}" itemscope itemtype="http://schema.org/Product">

    {block name='thumbnail_container'}
	  <div class="thumbnail-container">
	    {block name='product_image'}
          <div class="product-image">
	        <a href="{$product.url}" class="thumbnail product-thumbnail">
              <img class="img-fluid" src="{$product.cover.medium.url}" alt="{$product.cover.legend}" data-full-size-image-url="{$product.cover.large.url}" />
            </a>
	    	{block name='product_flags'}
              <ul class="product-flags">
                {foreach from=$product.flags item=flag}
                  <li class="{$flag.type}">{$flag.label}</li>
                {/foreach}
              </ul>
	    	  <div class="discount-type-flag">
	    	    {if $product.has_discount}
	    	      {if $product.discount_type === 'percentage'}
                    <span class="discount-percentage discount-product">{$product.discount_percentage}</span>
                  {elseif $product.discount_type === 'amount'}
                    <span class="discount-amount discount-product">{$product.discount_amount_to_display}</span>
                  {/if}
	    	    {/if}
	    	  </div>
            {/block}
	      </div>
        {/block}
	    
	    {block name='product_quick_view'}
        {/block}
	    
        {block name='product_meta'}
	      <div class="product-meta">
	    
	        {block name='product_name'}
              <h4 class="product-name{if isset($theme.len_of_pro_bck_name)}{if $theme.len_of_pro_bck_name == 1 || $theme.len_of_pro_bck_name == 2 || $theme.len_of_pro_bck_name == 4} nohidden{elseif $theme.len_of_pro_bck_name == 3} two_rows{/if}{/if}" itemprop="name"><a href="{$product.url}">{if isset($theme.len_of_pro_bck_name) && $theme.len_of_pro_bck_name == 1}{$product.name|truncate:70:$symbol}{elseif isset($theme.len_of_pro_bck_name, $theme.CC_len_of_pro_bck_name) && $theme.len_of_pro_bck_name == 4 && $theme.CC_len_of_pro_bck_name}{$product.name|truncate:$theme.CC_len_of_pro_bck_name:$symbol}{else}{$product.name}{/if}</a></h4>
            {/block}
	    
	    	{block name='product_description_short'}
	    	  {if isset($theme.show_short_desc) && $theme.show_short_desc}
	    	    <h6 class="product-desc" itemprop="description">{if $theme.show_short_desc == 1}{$product.description_short|strip_tags:false|truncate:200:$symbol}{elseif $theme.show_short_desc == 2}{$product.description_short nofilter}{elseif isset($theme.CC_show_short_desc) && $theme.CC_show_short_desc && $theme.show_short_desc == 3}{$product.description_short|strip_tags:false|truncate:$theme.CC_show_short_desc:$symbol}{/if}</h6>
	    	  {/if}
	    	{/block}
	    
	    	{block name='product_manufacturer_name'}
	    	  {if isset($product.manufacturer_name) && $product.id_manufacturer && $theme.display_pro_bck_brand_name}
	    	    <h6 class="product-manufacturer">{$product.manufacturer_name|truncate:60:$symbol}</h6>
	    	  {/if}
	    	{/block}
	    
	    	{block name='product_variants'}
	    	  {if $theme.display_color_list && $product.main_variants}
	    	    {include file='catalog/_partials/variant-links.tpl' variants=$product.main_variants}
	    	  {/if}
	    	{/block}
	    
	    	{block name='product_reference'}
	    	  {if isset($product.reference) && $product.reference && $theme.display_pro_bck_reference}
	    	    <div class="product-reference">{l s='Reference' d='Shop.Theme.Catalog'}: {$product.reference}</div>
	    	  {/if}
	    	{/block}
	    
	    	{block name='product_cate_name'}
	    	  {if $theme.display_pro_bck_cate_name}
	    	    <a href="{url entity='category' id=$product.id_category_default params=['alias' => $product.category]}" title="{$product.category_name}">{$product.category_name}</a>
	    	  {/if}
	    	{/block}
	    
            {block name='product_price_and_shipping'}
              {if $product.show_price}
                <div class="product-price-and-shipping">
                  {if $product.has_discount}
                    {hook h='displayProductPriceBlock' product=$product type="old_price"}
                    <span class="regular-price">{$product.regular_price}</span>
                  {/if}
                  {hook h='displayProductPriceBlock' product=$product type="before_price"}
                  <span itemprop="price" class="price">{$product.price}</span>
                  {hook h='displayProductPriceBlock' product=$product type="unit_price"}
                  {hook h='displayProductPriceBlock' product=$product type="weight"}
                </div>
              {/if}
            {/block}
	    
            {block name='product_availability'}
              {if $product.show_availability}
                {* availability may take the values "available" or "unavailable" *}
                <span class="product-availability {$product.availability}">{$product.availability_message}</span>
              {/if}
            {/block}
	    
            {hook h='displayProductListReviews' product=$product}
	    
	    	{block name='product_list_actions'}
              <div class="product-list-actions">
                {if $product.add_to_cart_url}
                    <a
                      class = "add-to-cart"
                      href  = "{$product.add_to_cart_url}"
                      rel   = "nofollow"
                      data-id-product="{$product.id_product}"
                      data-id-product-attribute="{$product.id_product_attribute}"
                      data-link-action="add-to-cart"
                    >{l s='Add to cart' d='Shop.Theme.Actions'}</a>
                {/if}
                {hook h='displayProductListFunctionalButtons' product=$product}
              </div>
            {/block}
	    
	      </div>
	    {/block}
	  </div>
	{/block}

  </article>
{/block}
