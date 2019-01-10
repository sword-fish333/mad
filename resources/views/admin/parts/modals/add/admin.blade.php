
<!-- Modal -->
<div class="modal fade" id="addAdmin" tabindex="-1" role="dialog" aria-labelledby="addAdmin" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header add_admin_header">
                <h5 class="modal-title add_admin_title"><u>Add Admin</u> <i class="fas fa-user-plus"></i></h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="/admin/admins/add" method="post">
                    @csrf
                    <div class="row offset-1">
                    <div class="form-group col-md-5">
                        <label for="name" class="admin_label">Name</label>
                        <input type="text" class="form-control" name="name" placeholder="..." required>
                    </div>
                    <div class="form-group col-md-5">
                        <label for="email" class="admin_label">Email</label>
                        <input type="email" class="form-control" name="email" placeholder="..." required>
                    </div>
                    <div class="form-group col-md-5">
                        <label for="phone" class="admin_label">Phone</label>
                        <input type="text" class="form-control" name="phone" placeholder="..." required>
                    </div>
                    </div>
                    <div class="row offset-1">
                        <div class="form-group col-md-5">
                            <label for="password" class="admin_label">Password</label>
                            <input type="password" class="form-control" name="password" placeholder="..." required>
                        </div>
                        <div class="form-group col-md-5" style="top: -24px;">
                            <label for="confirm_password" class="admin_label">Confirm Password <strong style="color: darkred">(The same with Password)</strong></label>
                            <input type="password" class="form-control" name="confirm_password" placeholder="..." required>
                        </div>
                        <div class="form-group col-md-5">
                            <label for="current_password" class="admin_label">Current Password <strong style="color: darkred;">(Mandatory)</strong></label>
                            <input type="password" class="form-control" name="current_password" placeholder="..." required>
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