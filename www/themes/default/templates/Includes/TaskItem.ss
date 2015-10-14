<div class="card card-block">
	<div class="checkbox m-b-0">
		<label>
			<input type="checkbox" <% if $isComplete %>checked="checked"<% end_if %> />
			<% if $isComplete %><del><% end_if %>
				$Title
			<% if $isComplete %></del><% end_if %>
			<a href="$Link('delete')">Remove</a>
		</label>
	</div>
</div>
