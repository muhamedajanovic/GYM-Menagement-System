<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.min.js" integrity="sha384-Rx+T1VzGupg4BHQYs2gCW9It+akI2MM/mndMCy36UVfodzcJcF0GGLxZIzObiEfa" crossorigin="anonymous"></script>
<script src="https://unpkg.com/dropzone@5/dist/min/dropzone.min.js"></script>

<script>
  Dropzone.options.dropzoneUpload = {
    url: "../backend/upload_photo.php",
    paramName: "photo",
    maxFilesize: 20, // MB acceptedFiles: "image/*",
    init: function() {
      this.on("success", function(file, response) {
        // Parse the JSON response
        const jsonResponse = JSON.parse(response);
        // Check if the file was uploaded successfully
        if (jsonResponse.success) {
          // Set the hidden input's value to the uploaded file's path
          document.getElementById('photoPathInput').value = jsonResponse.photo_path;
        } else {
          console.error(jsonResponse.error);
        }
      });
    }
  };
</script>