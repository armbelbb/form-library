<div class="modal fade" id="reportModal" tabindex="-1" aria-labelledby="reportModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="reportModalLabel">REPORT/CONCERN</h5>
            <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <!-- Insert your form or message here -->
            <form method="POST" action="actions.php" id="reportRequestForm">
            <div class="mb-3">
                <label for="reportDetails" class="form-label">Report details</label>
                <textarea class="form-control" name="request_concerns" rows="3" form="reportRequestForm" required></textarea>
            </div>
                <input type="hidden" form="reportRequestForm" name="form_request_id" id="form_request_id" required>
            </form>
        </div>
        <div class="modal-footer">
            <button class="btn btn-outline-danger" type="button" data-dismiss="modal">Cancel</button>
            <button type="submit" name="reportRequest" form="reportRequestForm" class="btn btn-outline-primary">Confirm</button>
        </div>
        </div>
    </div>
</div> 
<script>
var reportModal = new bootstrap.Modal(document.getElementById('reportModal'), {
    keyboard: false
})
</script>