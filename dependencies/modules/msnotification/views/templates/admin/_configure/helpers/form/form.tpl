{extends file="helpers/form/form.tpl"}
{block name="field"}
  {if $input.type == 'button'}
    <button id="{$input.name}" class="btn btn-default{if isset($input.class) && $input.class} {$input.class}{/if}" type="button">
	  <i class="{$input.icon}"></i> {$input.title}
	</button>
  {elseif $input.type == 'warning'}
    <div class="alert alert-warning">{$input.detail}</div>
  {else}
    {$smarty.block.parent}
  {/if}
{/block}