<div class="modal fade" id="reportModal" tabindex="-1" aria-labelledby="reportModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="reportModalLabel">CANCEL REQUEST</h5>
            <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <!-- Insert your form or message here -->
            <p>Are you sure you want to cancel this request?</p>
            <form method="POST" action="actions.php" id="cancelRequestForm">
            <!-- <div class="mb-3">
                <label for="reportType" class="form-label">Report type</label>
                <select class="form-select" id="reportType">
                <option selected>Select a report type</option>
                <option value="1">Inappropriate content</option>
                <option value="2">Abusive behavior</option>
                <option value="3">Spam</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="reportDetails" class="form-label">Report details</label>
                <textarea class="form-control" id="reportDetails" rows="3"></textarea>
            </div> -->
                <input type="hidden" form="cancelRequestForm" name="form_request_id" id="form_request_id" required>
            </form>
        </div>
        <div class="modal-footer">
            <button class="btn btn-outline-danger" type="button" data-dismiss="modal">Cancel</button>
            <button type="submit" name="cancelRequest" form="cancelRequestForm" class="btn btn-outline-primary">Confirm</button>
        </div>
        </div>
    </div>
</div> 
<script>
var reportModal = new bootstrap.Modal(document.getElementById('reportModal'), {
    keyboard: false
})
</script>