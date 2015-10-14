<div class="row">
	<h1>$TodoList.Title</h1>
	<p class="text-muted"><a href="$Link">&lt; back to task lists</a></p>
	<progress class="progress progress-striped <% if $TodoList.isComplete %>progress-success<% end_if %>" value="$TodoList.PercentComplete" max="100">{$TodoList.PercentComplete}%</progress>
</div>
<div class="row">
	<% if $TodoList.Tasks %>
		<% loop $TodoList.Tasks %>
			<div class="col-sm-12">
				<% include TaskItem %>
			</div>
		<% end_loop %>
	<% else %>
		<div class="alert alert-warning">Sorry, there are no tasks at the moment</div>
	<% end_if %>
	<div class="col-sm-12">
		$TaskForm
	</div>
</div>
