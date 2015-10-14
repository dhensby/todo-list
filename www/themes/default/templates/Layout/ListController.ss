<div class="row">
	<div class="col-sm-12">
		<h1>$Title</h1>
	</div>
</div>
<div class="row">
	<% if $Lists %>
		<% loop $Lists %>
			<div class="col-sm-4">
				<% include ListItem %>
			</div>
			<% if $MultipleOf(3) %>
				</div><div class="row">
			<% end_if %>
		<% end_loop %>
	<% else %>
		<div class="alert alert-warning">Sorry, there are no lists at the moment</div>
	<% end_if %>

	<div class="col-sm-4">
		<div class="card card-block">
			<h2 class="card-title">Add a new list</h2>
			$AddListForm
		</div>
	</div>
</div>
