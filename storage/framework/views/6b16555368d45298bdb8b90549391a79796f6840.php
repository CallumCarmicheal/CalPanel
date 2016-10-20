<form id="dashboard-user-logout-form" action="<?php echo e(url('/logout')); ?>" method="POST" style="display: none;">
	<?php echo e(csrf_field()); ?>

</form>

<div class="tab-pane fade" id="settings">
	<div class="col-md-6 col-md-offset-3">
		<div class="settings-panel">
			<div class="legend">Session</div>
			<button type="button" 
			        class="btn btn-default btn-lg btn-block btn-ripple" 
			        onclick="event.preventDefault();document.getElementById('dashboard-user-logout-form').submit();">Logout of CP</button>
			
			<br><br>
			<p class="text-grey"></p>
			<div class="legend">Privacy Controls</div>
			<ul>
				<li>
					Show my profile on search results
					<div class="switcher switcher-indigo pull-right">
						<input id="settings1" type="checkbox" hidden="hidden" checked="checked">
						<label for="settings1"></label>
					</div>
				</li>
				<li>
					Only God can judge me
					<div class="switcher switcher-indigo pull-right">
						<input id="settings2" type="checkbox" hidden="hidden" checked="checked">
						<label for="settings2"></label>
					</div>
				</li>
				<li>
					Review tags people add to your own posts
					<div class="switcher switcher-indigo pull-right">
						<input id="settings3" type="checkbox" hidden="hidden">
						<label for="settings3"></label>
					</div>
				</li>
			</ul>
			<div class="legend">Notifications</div>
			<ul>
				<li>
					Activity that involves you
					<div class="switcher switcher-indigo pull-right">
						<input id="settings4" type="checkbox" hidden="hidden" checked="checked">
						<label for="settings4"></label>
					</div>
				</li>
				<li>
					Birthdays
					<div class="switcher switcher-indigo pull-right">
						<input id="settings5" type="checkbox" hidden="hidden">
						<label for="settings5"></label>
					</div>
				</li>
				<li>
					Calendar events
					<div class="switcher switcher-indigo pull-right">
						<input id="settings6" type="checkbox" hidden="hidden">
						<label for="settings6"></label>
					</div>
				</li>
			</ul>
			<div class="legend">Newsletter</div>
			<ul>
				<li>
					Friend requests
					<div class="checkboxer checkboxer-indigo pull-right">
						<input type="checkbox" id="checkboxSettings1" value="option1" checked="checked">
						<label for="checkboxSettings1"></label>
					</div>
				</li>
				<li>
					People you may know
					<div class="checkboxer checkboxer-indigo pull-right">
						<input type="checkbox" id="checkboxSettings2" value="option1">
						<label for="checkboxSettings2"></label>
					</div>
				</li>
			</ul>
		</div>
	</div>
</div>
