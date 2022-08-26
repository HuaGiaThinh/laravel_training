<div class="input-group">
    <select class="form-control custom-select bulk-select">
        <option value="default">Bulk Action</option>
        <option value="multy_active">Active</option>
        <option value="multy_inactive">Inactive</option>
        <option value="multy_delete">Delete</option>
    </select>
    <span class="input-group-append">
        <button
            data-url="/index.php?module=backend&controller=user&action=value_new"
            type="button"
            class="btn btn-info btn-bulk-apply">Apply</button>
    </span>
</div>