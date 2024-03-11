

function bind(binder,content){
    let formData = new FormData();

    for(let i = 0; i < binder.length; i++){
        formData.append(binder[i],content[binder[i]])
    }

    return formData;
}


export default bind