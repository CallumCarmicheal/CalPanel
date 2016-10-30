Page = {
	Name: "Admin: Roles -> Edit",
	
	Role: {
		Slug:       "",
		Name:       "",
		IsHighest:  false
	},
	
	Lib: {
		HideRow: function($row) {
			$row.fadeOut(1000, function(){
				$row.remove();
			});
		},
	},

	API: {

	}
};

function onPermsSubmit() {
	var data = {
		_method: 'patch',
		perms: [ ]
	};
	
	/* var perm = {
		id: '',
		en: true 
	} */
	
	$('.tog_perm').each(function( i, e ){
		var $e  = $(e);
		var chk  = $e.is(':checked') ? 1 : 0;
		var pid  = $e.attr('pid');
		data.perms.push({id: pid, en: chk});
	});
	
	console.log("Data: ", data);
	
	// Use the modal
	$perms_modal_AYS.modal('show');

	$perms_AYS_PInfo.html(Page.Role.Name + " [slug:" + Page.Role.Name + "]");

	$perms_Btn.off('click');
	$perms_Btn.on('click', function() {
		var route = Laravel.RootURL + "admin/role/";
		route += Page.Role.Slug;
		
		// Post the data
		$.ajax({
			url:  route, type: 'post',
			data: data,
			success: function(r) {
				$perms_modal_AYS.modal('hide');
				
				console.log(r);
				
				/*var model = {
					success: bool	
				};*/
				
				if (r.success) {
					$perms_modal_SUC.modal('show');
					$perms_SUC_Refsh.off('click');
					$perms_SUC_Refsh.on('click', function(){
						window.location.reload();
					});

					$perms_SUC_Cont.off('click');
					$perms_SUC_Cont.on('click', function(){
						
						$.each(data.perms, function(x, obj) {
							var model = {
								id: 0,
								en: 0-1
							}; model = obj;
							
							$elem = $("#tog_perm_" + model.id);
							$elem.attr("checked", model.en == 1 ? true : false);
						});
					});
				}
			}
		});
	});
}

function simplePopup(title, message, callback) {
	// Make sure its not open
	$message_Modal.modal('hide');
	
	var $header = $($message_Modal.find('.modal-title')[0]);
	var $body   = $($message_Modal.find('.modal-body')[0]);
	
	console.log($header, $body);
	
	$header.html(title);
	$body.html(message);
	
	// Set callbacks
	if(callback != null) {
		$message_Okay.off('click');
		$message_Okay.on('click', function () {
			$message_Modal.modal('hide');
			callback();
		});
	}
	
	$message_Modal.modal('show');
}

function yesnoPopup(title, message, cbYes, cbNo) {
	var $modal = $yesno_Modal;
	
	// Make sure its not open
	$modal.modal('hide');

	var $header = $($modal.find('.modal-title')[0]);
	var $body   = $($modal.find('.modal-body')[0]);

	console.log($header, $body);

	$header.html(title);
	$body.html(message);

	// Set callbacks
	if(cbYes != null) {
		$yesno_Yes.off('click');
		$yesno_Yes.on('click', function() {
			$modal.modal('hide');
			cbYes();
		});
	}
	
	if (cbNo != null) {
		$yesno_No.off('click');
		$yesno_No.on('click', function() {
			$modal.modal('hide');
			cbNo();
		});
	}

	$modal.modal('show');
}

function setAllPermissions(state) {
	$('.tog_perm').each(function( i, e ){
		var $e = $(e);
		$e.prop('checked', state);
	});
}

function toggleAllPermissions() {
	$('.tog_perm').each(function( i, e ){
		var $e = $(e);
		var state = !$e.is(':checked');
		$e.prop('checked', state);
	});
}

function deleteUser(id, name, extra) {
	yesnoPopup(
		'Are you sure?',
		'Are you sure you want to delete the user ' + name + ' with the attributes: ' + extra,
		function() {

			var data = {
				_method: 'delete',
				id: id
			};

			// admin/role/{slug}/u/{email}
			var route = Laravel.RootURL + "admin/role/";
			route += Page.Role.Slug;
			route += "/u/";
			route += id;

			console.log(route);

			$.ajax({
				url:  route, type: 'post',
				data: data,
				success: function(r) {
					var model = {
						success: true,
						message: ""
					};

					model = r;

					if(model.success) {
						simplePopup(
							'Removed the user from ' + Page.Role.Name,
							'The user ' + name + ' with the attributes: ' + extra
							+ ' has been removed from the role ' + Page.Role.Name +
							" [slug:" + Page.Role.Name + "]",
							function() { Page.Lib.HideRow($parent); });
					} else {
						simplePopup(
							'Error while removing user',
							'The user ' + name + ' with the attributes: ' + extra
							+ ' could not be removed from the role ' + Page.Role.Name +
							" [slug:" + Page.Role.Name + "]" + "\n\nServer Message: " + model.message,
							null);
					}
				}
			});
		}, null);
}

var $usersInput         = null;
var $permsAdd           = null;
var $usersAdd           = null;

var $perms_modal_AYS    = null;
var $perms_AYS_PInfo    = null;
var $perms_Btn          = null;
var $perms_AYS_Submt    = null;
var $perms_modal_SUC    = null;
var $perms_SUC_Refsh    = null;
var $perms_SUC_Cont     = null;
var $perms_BTN_EnAll    = null;
var $perms_BTN_DsAll    = null;
var $perms_BTN_Toggl    = null;

var $message_Modal      = null;
var $message_Okay       = null;

var $yesno_Modal        = null;
var $yesno_Yes          = null;
var $yesno_No           = null;

var selUser             = "";
var selUserRaw          = "";

$(function() {
	$usersInput         = $('#page_users_add');
	$usersAdd           = $('#page_add_user');
	
	$perms_modal_AYS    = $('#page_perms_areyousure');
	$perms_AYS_PInfo    = $('#page_perms_areyousure_perminfo');
	$perms_Btn          = $('#page_perms_areyousure_btn');
	$perms_AYS_Submt    = $('#page_submit_perms');
	
	$perms_modal_SUC    = $('#page_perms_success');
	$perms_SUC_Refsh    = $('#page_perms_success_refresh');
	$perms_SUC_Cont     = $('#page_perms_success_dismiss');

	$perms_BTN_EnAll    = $('#page_perms_btn_enall');
	$perms_BTN_DsAll    = $('#page_perms_btn_dsall');
	$perms_BTN_Toggl    = $('#page_perms_btn_toggle');

	$message_Modal      = $('#page_simple_modal');
	$message_Okay       = $('#page_simple_modal_ok');

	$yesno_Modal        = $('#page_yn_modal');
	$yesno_Yes          = $('#page_yn_modal_yes');
	$yesno_No           = $('#page_yn_modal_no');
	
	$usersInput.autocomplete({
		lookup: function (query, done) {
			var route = Laravel.RootURL + "admin/ajax/user/list/ac/";
			route += Page.Role.Slug + "/";
			route += $usersInput.val();
			
			$.ajax({
				url:  route, type: 'post',
				success: function(r) { done(r); }
			});
		},
		onSelect: function (suggestion) {
			selUser = suggestion.data;
			selUserRaw = suggestion.value;
			console.log("Selected user: " + selUser);
		}
	});

	$usersAdd.on('click', function(){
		yesnoPopup('Are you sure?', 
			'Are you sure you want to add "' + selUserRaw + '" to ' + 
				Page.Role.Name + ' [slug:' + Page.Role.Slug + ']?',
			function () {
				var data = { _method: "patch" };
				
				var model = {
					success: false,
					message: ""
				};

				// admin/role/{slug}/u/{email}
				var route = Laravel.RootURL + "admin/role/";
				route += Page.Role.Slug;
				route += "/u/";
				route += selUser;

				// Post the data
				$.ajax({
					url:  route, type: 'patch',
					success: function(r) {  
						model = r;
						
						if (model.success) {
							simplePopup("User added", "Press okay to refresh and see the added users", 
							function() {
								window.location.reload();
							});
						} else {
							simplePopup("Failed to add user", 
								"Server returned message: " + r.message, null);
						}
					}
				});
			}, null
		);
	});
	
	$('.page-user-btn').on('click', function() {
		$this   = $(this);
		id      = $this.attr('user_id');
		
		$parent = $($($($this.parent()).parent())[0]);
		name    = $($parent.find('.title')[0]).html().trim();
		extra   = $($parent.find('.caption')[0]).html().trim();
		
		deleteUser(id, name, extra);
	});
	
	// Touch support
	
	$('.page-edit-user-tab').on('click', function() {
		if (Laravel.Website.isTouch()) {
			$parent     = $(this);
			$ide        = $($parent.find('.page-user-btn')[0]);
			id          = $ide.attr('user_id');
			name        = $($parent.find('.title')[0]).html().trim();
			extra       = $($parent.find('.caption')[0]).html().trim();
			deleteUser(id, name, extra);
		}
	});

	$('#page_delete_role').on('click', function() {
		var topic = 'Delete ' + Page.Role.Name;
		var desc  = 'Are you sure you want to delete this role? ' + Page.Role.Name + 
					" [slug:" + Page.Role.Name + "]" + "\n";
 
		yesnoPopup(topic, desc, 
		function() {
			// Delete the role

			var data = { _method: "delete" };
			var route = Laravel.RootURL + "admin/role/" + Page.Role.Slug;

			$.ajax({
				url:  route, type: 'post',
				data: data, success: function(r) {
					var model = {
						success: true,
						message: ""
					}; model = r;

					if (model.success) {
						window.location = Laravel.RootURL + "admin/roles";
					} else {
						simplePopup(
							'Failed to delete role',
							'There was a error when deleting the role. Server Response: ' + model.message);
					}
				}
			});
		}, null);
	});
	
	
	$perms_BTN_EnAll.on('click', function() { setAllPermissions(true); });
	$perms_BTN_DsAll.on('click', function() { setAllPermissions(false); });
	$perms_BTN_Toggl.on('click', toggleAllPermissions);
	$perms_AYS_Submt.on('click', onPermsSubmit);
});