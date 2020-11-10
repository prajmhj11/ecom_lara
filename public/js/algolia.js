$(function(){
    const client = algoliasearch('T8DHNBCHPS', '7cf7dc74272f561034b491c75406b746');
    const index = client.initIndex('products');
    let enterPressed = false;
    autocomplete('#aa-search-input', {}, [
        {
          source: autocomplete.sources.hits(index, { hitsPerPage: 5 }),
          displayKey: 'name',
          templates: {
            header: '<div class="aa-suggestions-category">Products</div>',
            suggestion(suggestion) {
                var presentPrice = suggestion.price/100;
                const markup = `
                    <div class="algolia-result d-flex">
                        <span>
                            <img src="${window.location.origin}/storage/${suggestion.image}" class="img-thumbnail" alt="img"/>
                            ${suggestion._highlightResult.name.value}
                        </span>
                        <span>$${presentPrice.toFixed(2)}</span>
                    </div>
                    <div class="algolia-details d-flex">
                        <span>${suggestion._highlightResult.details.value}</span>
                    </div>
                `;
                return markup;
                // return `<span>${suggestion._highlightResult.name.value}</span><span>$` + presentPrice.toFixed(2) + `</span>`;
            },
            empty(result){
                return `Sorry, we did not find any results for ${result.query}`;
            }
          }
        },
    ]).on('autocomplete:selected', (event, suggestion, dataset)=>{
        window.location.href = window.location.origin + '/shop/' + suggestion.slug;
        enterPressed = true;
    }).on('keyup', (e)=>{
        if(e.keyCode == 13 && !enterPressed){
            var query = $('#aa-search-input').val();
            window.location.href = window.location.origin + '/search-algolia?q=' + query ;
        }
    });
})

