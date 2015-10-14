<div class="card card-block">
	<h2 class="card-title">$Title</h2>
	<progress class="progress progress-striped <% if $isComplete %>progress-success<% end_if %>" value="$PercentComplete" max="100">{$PercentComplete}%</progress>
	<div class="alert <% if $isComplete %>alert-success<% else_if not $Tasks %>alert-warning<% else %>alert-info<% end_if %>">
		<% if $Tasks %>
			Complete: $CompleteTasks.Count / $Tasks.Count ({$PercentComplete}%)
		<% else %>
			No tasks yet
		<% end_if %>
	</div>
	<a href="$Link" class="btn btn-primary">View list</a>
	<a href="$Link('delete')" class="btn btn-danger-outline">Delete list</a>
</div>
