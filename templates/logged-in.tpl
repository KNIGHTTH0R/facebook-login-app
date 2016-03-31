{include file="header.tpl" logout=true}
<div class="jumbotron">
    <h1>Hi {$name}!</h1>
    <p class="lead">This is your profile picture:</p>
    <img src="{$image}" alt="Profile Picture" />
	<p>You may now log out again</p>
</div>
{include file="footer.tpl"}