
<!-- Modal -->
<div class="modal fade" id="editAdmin-{{$admin->id}}" tabindex="-1" role="dialog" aria-labelledby="editAdmin-{{$admin->id}}" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header edit_admin_header">
                <h5 class="modal-title add_admin_title"><u>Add Admin</u> <i class="fas fa-user-edit"></i></h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="/admin/admins/edit/{{$admin->id}}" method="post">
                    @csrf
                    <div class="row offset-1">
                    <div class="form-group col-md-5">
                        <label for="name" class="admin_label">Name</label>
                        <input type="text" class="form-control" name="name" value="{{$admin->name}}" placeholder="...">
                    </div>
                    <div class="form-group col-md-5">
                        <label for="email" class="admin_label">Email</label>
                        <input type="email" class="form-control" name="email" value="{{$admin->email}}" placeholder="...">
                    </div>
                    <div class="form-group col-md-5">
                        <label for="phone" class="admin_label">Phone</label>
                        <input type="text" class="form-control" name="phone"value="{{$admin->phone}}" placeholder="...">
                    </div>
                    </div>
                    <div class="row offset-1">
                        <div class="form-group col-md-5">
                            <label for="password" class="admin_label">New Password</label>
                            <input type="password" class="form-control" name="password" placeholder="..." >
                        </div>
                        <div class="form-group col-md-5">
                            <label for="confirm_password" class="admin_label">Confirm Password</label>
                            <input type="password" class="form-control" name="confirm_password" placeholder="..." >
                        </div>
                        <div class="form-group col-md-5">
                            <label for="current_password" class="admin_label">Current Password <strong style="color: darkred;">(Mandatory)</strong></label>
                            <input type="password" class="form-control" name="current_password" placeholder="..." >
                        </div>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Save changes</button>
                </form>
            </div>
        </div>
    </div>
</div>