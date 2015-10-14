<fieldset id="$HolderID" class="form-group">
	<% if $Title %><label for="$ID">$Title</label><% end_if %>
	$Field
	<% if $RightTitle %><small class="text-muted">$RightTitle</small><% end_if %>
	<% if $Message %><small class="text-muted">$Message</small><% end_if %>
	<% if $Description %><small class="text-muted">$Description</small><% end_if %>
</fieldset>
