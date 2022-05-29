//caricherò i contenuti che l'utente ha salvato
loadSaved();

function loadSaved(){
    fetch("load_saved.php").then(onResponseLoad).then(onJsonLoad);
}

function onResponseLoad(response){
    console.log(response);
    return response.json();
}

function onJsonLoad(json){
    console.log(json);

    const container = document.querySelector('.container');

    container.innerHTML = '';

    for(let i in json){
        const jsoni = json[i];

        const element_id = jsoni[0];
        const img = jsoni[1].url;
        const label = jsoni[1].label;
        const cuisine = jsoni[1].type;

        //console.log(element_id);
        // console.log(image);
        // console.log(name);
        // console.log(cuisine);

        const content = document.createElement('div');
        content.classList.add('content');

        const img_rec = document.createElement('img');
        img_rec.classList.add('img_rec');
        img_rec.src = img;

        const bottom = document.createElement('div');
        bottom.classList.add('bottom');

        const title = document.createElement('div');
        title.classList.add('title');
        title.textContent = label;

        const type = document.createElement('div');
        type.classList.add('type');
        type.textContent = 'Tipo di cucina: ' + cuisine;

        const text = document.createElement('div');
        text.classList.add('text');

        const x = document.createElement('div');
        x.classList.add('x');

        x.dataset.element_id = element_id;

        x.addEventListener('click',removeElement);


        text.appendChild(title);
        text.appendChild(type);

        bottom.appendChild(text);
        bottom.appendChild(x);

        content.appendChild(img_rec);
        content.appendChild(bottom);

        container.appendChild(content);


    }
   
}


function removeElement(event)
{
    event.preventDefault();
    const element_id = event.currentTarget.dataset.element_id;
    fetch("delete_element.php?element_id=" + element_id).then(loadSaved);
}