<!DOCTYPE html>
    <html lang="nl">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <title>Create a Thread</title>

        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />

        <style>
            .first-row {
                margin-top: 40px;
                margin-bottom: 30px;
            }
        </style>
    </head>
    <body>
    <div class="container">
        <div class="row first-row">
            <div class="col-md-8">
                <h1>Create a Thread</h1>
            </div>
            <div class="col-md-4">
                <a href="index.php" class="btn btn-success float-end">Terug naar home</a>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div id="api-result">
                    <!-- Hier laten we de response van de API zien na een sbumit -->
                </div>
                <!--
                     Het formulier krijgt een ID omdat we via JavaScript willen voorkomen dat de standaard actie
                     door de browser wordt uitgevoerd. Dus halen we het formulier binnen en JavaScript en koppelen
                     we hier een eventlistener aankoppelen voor de submit event.
                -->
                <form id="create-thread-form">
                    <!-- We simuleren met de hidden input tag hieronder dat een admin de thread aanmaakt -->
                    <input type="hidden" name="user_id" value="1" />
                    <div class="mb-3">
                        <label for="titel" class="form-label">Titel</label>
                        <!-- Een input tag moet een name attribuut hebben waarbij de naam gelijk is aan de kolom in de tabel -->
                        <input type="text" id="titel" name="title" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label for="beschrijving" class="form-label">Beschrijving</label>
                        <!-- Ook een textarea moet een name attribuut hebben met de naam van de kolom in de database -->
                        <textarea type="text" id="beschrijving" name="description" class="form-control" rows="8"></textarea>
                    </div>
                    <div class="mb-3 float-end">
                        <button type="submit" class="btn btn-primary">Opslaan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js" integrity="sha512-RXf+QSDCUQs5uwRKaDoXt55jygZZm2V++WUZduaU/Ui/9EGp3f/2KZVahFZBKGH0s774sd3HmrhUy+SgOFQLVQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="js/create-thread.js"></script>
    </body>
</html>