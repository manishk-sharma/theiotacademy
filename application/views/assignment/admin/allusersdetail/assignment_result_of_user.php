<?php
if ($this->session->userdata("user")) {
?>
    <link rel="stylesheet" href="<?php echo asset_url() ?>admin/css/site.css">
    <?php $this->load->view("assignment/admin/common/adminheader.php"); ?>
    <style type="text/css">
        .batch_result_div {
            display: flex;
            justify-content: center;
        }

        .form_of_batch_result {
            box-shadow: rgba(0, 0, 0, 0.1) 0px 0px 5px 0px, rgba(0, 0, 0, 0.1) 0px 0px 1px 0px;
            width: 400px;
            margin-top: 5%;
            padding: 40px 30px;

        }

        .submitbtn {
            width: 150px;
            border-radius: 25px;
            font-weight: bold;
        }
    </style>

    <div class="container-fluid">
        <h3 class="text-center heading mt-4 mb-4">Download Assignment Result </h3>

        <div class="batch_result_div">

            <form id="Download_Batch_Result_submit" method="post" class="form_of_batch_result">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="mb-2">Choose Batch For Download Result</div>
                        <select name="batch_name" class="form-control">
                            <option value="">--Choose Batch--</option>
                            <option value="Batch-1">Batch-1</option>
                            <option value="Batch-2">Batch-2</option>
                            <option value="Batch-3">Batch-3</option>
                            <option value="Batch-4">Batch-4</option>
                            <option value="Batch-5">Batch-5</option>
                            <option value="Batch-6">Batch-6</option>
                            <option value="Batch-7">Batch-7</option>
                            <option value="Batch-8">Batch-8</option>
                            <option value="Batch-9">Batch-9</option>
                            <option value="Batch-10">Batch-10</option>
                            <option value="Batch-11">Batch-11</option>
                            <option value="Batch-1-6-months">Batch-1 (6 Months)</option>
                            <option value="Batch-2-6-months">Batch-2 (6 Months)</option>
                            <option value="Batch-3-6-months">Batch-3 (6 Months)</option>
                            <option value="Batch-4-6-months">Batch-4 (6 Months)</option>
                            <option value="Batch-5-6-months">Batch-5 (6 Months)</option>
                            <option value="Batch-12">Batch-12</option>
                            <option value="Batch-13">Batch-13</option>
                            <option value="Batch-14">Batch-14</option>
                            <option value="Batch-15">Batch-15</option>
                            <option value="Batch-16">Batch-16</option>
                        </select>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12 text-center mt-4 mb-4">
                        <input class="btn btn-primary p-2 px-4" type="submit" value="Download Result" />
                    </div>
                </div>
            </form>

        </div>

    </div>

    <?php $this->load->view("assignment/admin/common/adminfooter.php"); ?>

    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

    <script>
        function removeTags(str) {
            if ((str === null) || (str === ''))
                return false;
            else
                str = str.toString();
            return str.replace(/(<([^>]+)>)/ig, '');
        }

        document.getElementById("Download_Batch_Result_submit").addEventListener("submit", function(e) {
            e.preventDefault();
            const formUrl = '<?= base_url() ?>AssignmentAllUserAdmin/download_result_batch_wise_function';
            const formData = new FormData(this);

            fetch(formUrl, {
                    method: 'POST',
                    body: formData
                })
                .then(response => response.text())
                .then(csvText => {
                    console.log("Raw CSV Response:", csvText);

                    if (!csvText.trim() || csvText.toLowerCase().includes("error")) {
                        alert("Error: No data available or an issue occurred.");
                        return;
                    }
                    let blob = new Blob([csvText], {
                        type: "text/csv"
                    });
                    let link = document.createElement("a");
                    link.href = window.URL.createObjectURL(blob);
                    link.download = "assignment_results.csv"; // Set filename
                    document.body.appendChild(link);
                    link.click();
                    document.body.removeChild(link);
                })
                .catch(error => {
                    console.error("Download Error:", error);
                    alert("Failed to download CSV.");
                });
        });
    </script>

<?php } else {
    redirect(base_url() . "assignment-login");
} ?>