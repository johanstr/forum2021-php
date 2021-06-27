let create_thread_form = document.querySelector('#create-thread-form');
let api_result = document.querySelector('#api-result');

/*
    We koppelen nu gelijk de submit event handler aan het formulier
 */
window.onload = function () {
    create_thread_form.addEventListener('submit', submitForm);
}

/*
    Als parameter van deze functie geven e op (e staat voor event informatie)
    De informatie in de parameter e wordt standaard door de browser gevuld met
    allerlei relevante informatie over het event, en meer info.
    Deze hebben we nodig om de browser te vertellen dat hij geen standaard submit
    actie mag uitvoeren.
 */
function submitForm(e)
{
    // Dit is de opdracht die de browser verteld niet de standaard actie uit te voeren
    e.preventDefault();

    // Hieronder, en nu pas, gaan we zelf bepalen wat er wel moet gebeuren na de submit
    // We roepen daarvoor een asynchrone functie aan om de api te benaderen met de formulier
    // gegevens.
    callAPI();
}

async function callAPI()
{
    /*
        Voor een POST request voegen we als tweede parameter aan de functie fetch een object toe,
        dit is een zogenaamde header object.
        In dit object vertellen we dat we een POST request willen versturen en in dit object vertellen we
        ook welke data (dus uit het formulier) moet worden meegestuurd naar de API.
     */
    await fetch('http://forum-php-api.test/thread', {
        method: 'POST',                             // Hier geven we aan dat het om een POST-request gaat
        body: new FormData(create_thread_form)      // Hier geven we de data uit het formulier door
    })
        .then(response => response.json())
        .then(data => {
            // Nu kunnen we met de response van de API iets doen, we laten de response van de
            // API zien op het scherm
            api_result.innerHTML = `
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    ${data.data.msg}.<br />De nieuwe thread heeft ID: <strong>${data.data.id}</strong>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            `;


            /*
                Wat we nu gaan doen is het formulier leeg maken. We blijven dus wel in dit scherm
                Uitleg code:
                * create_thread_form.children
                verwijst naar alle elementen in de form, Op index = 0 staat de hidden input en op index = 1
                staat de div waarin de label en de input zitten voor de titel invoer.
                * create_thread_form.children[1]
                ZO krijgen we de div met de label-tag en input-tag voor de title invoer
                * create_thread_form.children[1].children
                Zo krijgen we een array met op index = 0 de label en op index = 1 de input-tag
                * create_thread_form.children[1].children[1]
                Zo krijgen we de input-tag van de titel invoer en kunnen dan de value van deze
                input weer op leeg ('') zetten.
             */
            create_thread_form.children[1].children[1].value = '';      // Input - Title
            create_thread_form.children[2].children[1].value = '';      // Textarea - Description
        })
        .catch(error => {
            api_result.innerHTML = `
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong>FOUT!</strong><br />
                    ${error}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            `;
        });
}