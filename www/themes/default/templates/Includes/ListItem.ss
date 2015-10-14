<div class="card card-block">
	<h2 class="card-title">$Title</h2>
	<div class="alert alert-info">
		<% if $Tasks %>
			Complete: $CompleteTasks.Count / $Tasks.Count ({$PercentComplete}%)
		<% else %>
			No tasks yet
		<% end_if %>
	</div>
	<a href="$Link" class="btn btn-primary">View list</a>
	<a href="$Link('delete')" class="btn btn-danger-outline">Delete list</a>
</div>
