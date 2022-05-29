const form=document.querySelector('form');
form.addEventListener('submit',Search);

const container=document.querySelector('.container');


function Search(event){
    event.preventDefault();
    const recipe_input = document.querySelector(".cerca_ricette input");
    const recipe_value = encodeURIComponent(recipe_input.value);
    console.log('Eseguo ricerca: ' + recipe_value);
    fetch("search_recipe.php?q="+recipe_value).then(searchResponse).then(searchJson);
}

function searchResponse(response){
    console.log(response);
    return response.json();
}

function searchJson(json){
    console.log(json);
    showResults(json);
}

function showResults(json){
    container.innerHTML = '';
    const results = json.hits;
    let num_results = results.length;

    if(num_results > 6)
    num_results = 6;

    for(let i=0; i<num_results; i++){
        const recipe_data = results[i]
    
        const name = recipe_data.recipe.label;
        const image = recipe_data.recipe.images.REGULAR.url;
        const cuisine = recipe_data.recipe.cuisineType[0];

        const content = document.createElement('div');
        content.classList.add('content');

        var currentUrl = recipe_data.recipe.uri;

        var id = currentUrl.substring(51);
        content.dataset.id = id;

        const bottom = document.createElement('div');
        bottom.classList.add('bottom');

        const text = document.createElement('div');
        text.classList.add('text');

        const title = document.createElement('div');
        text.classList.add('title');
        text.textContent = name;

        const type = document.createElement('div');
        type.classList.add('type');
        type.textContent = "Tipo di cucina: " + cuisine;

        const more = document.createElement('div');
        more.classList.add('more');

        text.appendChild(title);
        text.appendChild(type);

        bottom.appendChild(text);
        bottom.appendChild(more);

        const img_rec = document.createElement('img');
        img_rec.classList.add('img_rec');
        img_rec.src = image;

        content.appendChild(img_rec);
        content.appendChild(bottom);

        container.appendChild(content);

        content.addEventListener('click', Select);
    }
}

var id='';

function Select(event){
    const modal = document.querySelector('#modal');
    modal.classList.remove('hidden');
    document.body.classList.add('no-scroll');

    const paragraph = document.querySelector('.paragraph');
    
    const butt = paragraph.querySelector('.salva');
    butt.classList.remove('hidden');

    const success=paragraph.querySelector('#success');
    success.classList.add('hidden');

    const img = document.createElement('img');
    const evento = event.currentTarget;
    const img_recipe = evento.querySelector('.img_rec');
    img.src = img_recipe.src;
    const body = document.querySelector('.body');
    body.appendChild(img);

    id = event.currentTarget.dataset.id;
}

const esc=document.querySelector('#modal .esc');
esc.addEventListener('click',hideModal);

function hideModal(event){
    const modal = document.querySelector('#modal');
    modal.classList.add('hidden');
    const body = document.querySelector('.body');
    body.innerHTML = '';
    document.body.classList.remove('no-scroll');
}

document.querySelector(".salva form").addEventListener("submit", savePost);

function savePost(event){
    event.preventDefault();

    const formData = new FormData(document.querySelector("#modal form"));
    formData.append('id', id);
    fetch("save_post.php", {method: 'post', body: formData}).then(saveResponse,saveError);

}


function saveResponse(response) {

    butt.classList.add('hidden');
    fail.classList.add('hidden');
    success.classList.remove('hidden');

    if(!response.ok) {
        saveError();
        return null;
    }
    console.log(response);
    return response.json().then(databaseResponse); 
}

const paragraph = document.querySelector('.paragraph');
const butt = paragraph.querySelector('.salva');
const success = paragraph.querySelector('#success');
const fail = paragraph.querySelector('#fail');

function saveError(error) {     
    butt.classList.add('hidden');
    success.classList.add('hidden');
    fail.classList.remove('hidden');
    
    console.log('errore');
}

function databaseResponse(json) {
    if (!json.ok) {
        saveError();
        return null;
    }
    console.log('ok');
}




