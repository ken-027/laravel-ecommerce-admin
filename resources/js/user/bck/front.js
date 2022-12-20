const navigationProperties = {
    offset : 'left-[-80%]',
    default : 'left-0',
}
const searchCompenentProperties = {
    offset : 'right-[-100%]',
    default : 'right-0',
}

function toggleNavigation(){
    const  navigation = document.getElementById('navigation');
    if (navigation.classList.contains(navigationProperties.offset)){
         navigation.classList.replace(navigationProperties.offset, navigationProperties.default);
         return;        
    }
    navigation.classList.replace(navigationProperties.default, navigationProperties.offset);   
}
function toggleDropDownList(el){
    const parentElement = el.parentElement;
    const dropdownList = parentElement.querySelector('.dropdownlist');
    dropdownList.classList.toggle('show');
}
function toggleSearchBar(){    
    const searchWrapper = document.querySelector('.sm-search')
    searchWrapper.classList.toggle('hidden')
    if (searchWrapper.classList.contains(searchCompenentProperties.offset)){
        searchWrapper.classList.replace(searchCompenentProperties.offset, searchCompenentProperties.default);  
        return;
    }             
    searchWrapper.classList.replace(searchCompenentProperties.default, searchCompenentProperties.offset);
}

function clearInputSearch(el){
    const inputSearch = el.parentElement.querySelector('.input-search')
    inputSearch.value = null
    el.classList.add('hidden');
}



document.getElementById('close-menu').addEventListener('click', toggleNavigation)
document.getElementById('open-menu').addEventListener('click', toggleNavigation)
document.getElementById('open-search').addEventListener('click', toggleSearchBar);
document.getElementById('close-search').addEventListener('click', toggleSearchBar);
document.querySelectorAll('.nav-dropdown').forEach(nav => {
    nav.addEventListener('click', function() {
            toggleDropDownList(nav);
    }) 
})

document.querySelectorAll('.seach-close-icon').forEach(element => {
    element.onclick = () => { clearInputSearch(element)  };
});

document.querySelectorAll('.input-search').forEach(element => {
    element.onkeydown =  function() {    
        const closeIcon = document.querySelector('.seach-close-icon')
        if(this.value != null) closeIcon.classList.remove('hidden')
    }     
});


document.addEventListener('click', event => {
    const nav  = document.querySelector('.nav-dropdown');
    const el = document.querySelector('.dropdownlist');
        
    if(event.target == el) return;     
    
    if(event.target != nav)    {        
        el.classList.remove('show');
    }
    
   
})

