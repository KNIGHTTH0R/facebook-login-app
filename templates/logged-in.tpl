{include file="header.tpl" logout=true}
<div class="jumbotron">
    <h1>Hi {$name}!</h1>
	{if $user_has_picture}
    <p class="lead">This is your profile picture:</p>
    <img src="{$image}" alt="Profile Picture" />
	{else}
	<p class="lead">It looks like you don't have a profile picture</p>
	{/if}
	<p style="margin-top: 35px;">You may now log out again</p>
</div>
{include file="footer.tpl"}