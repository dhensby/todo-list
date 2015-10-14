<% if $IncludeFormTag %>
	<form $AttributesHTML>
<% end_if %>

<% if $Message %>
		<div id="{$FormName}_error" class="alert alert-$MessageType">$Message</div>
<% else %>
		<div id="{$FormName}_error" class="alert alert-$MessageType" style="display: none">$Message</div>
<% end_if %>

<% loop $Fields %>
	$FieldHolder
<% end_loop %>

<% if $Actions %>
	<% loop $Actions %>
		$Field
	<% end_loop %>
<% end_if %>

<% if $IncludeFormTag %>
	</form>
<% end_if %>
