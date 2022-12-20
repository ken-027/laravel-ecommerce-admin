

    let isSearch = false

    function getListByModel(model, id){
        $.ajax({
            url : `/mobiles/${model}/${id}`,
            type : 'GET',
            sync : false,
            success : function(response){
                const wrapper = document.getElementById('device-list-wrapper');
                wrapper.innerHTML = null;
                response.mobiles.forEach(mobile => {
                   const li =  createTemplate(`
                        <a href="#" style="height: 261.188px;">
                             <div class="brand-image"><img src="/images/mobile/${mobile.model_img}" alt="${mobile.title}"></div>	<h6 class="h6">${mobile.title}</h6>
                        </a> 
                   `); 
                   wrapper.append(li);   
                });
                
              
            }
        })
    }  

    function search(el){
        const spanClose = el.parentElement.querySelector('.search-close-icon');
        spanClose.classList.remove('hidden');        
        const input = document.querySelector('input[type="search"]').value;
        $.ajax({
            url : `/mobiles/search/`,
            type : 'GET',
            data : { search : input },
            sync : false,
            success : function(response){
                const wrapper = document.getElementById('device-list-wrapper');
                wrapper.innerHTML = null;
                response.mobiles.forEach(mobile => {
                   const li =  createTemplate(`
                        <a href="#" style="height: 261.188px;">
                             <div class="brand-image"><img src="/images/mobile/${mobile.model_img}" alt="${mobile.title}"></div>	<h6 class="h6">${mobile.title}</h6>
                        </a> 
                   `); 
                   wrapper.append(li);   
                });
                
              
            }
        })
    } 

    function createTemplate(template)
    {
        const element = document.createElement('li');
        element.innerHTML = template;
        return element;
    }

    function hideSeachIcon(el){
        el.classList.add('hidden')
        el.parentElement.querySelector('input[type="search"]').value = null;        
    }

    

