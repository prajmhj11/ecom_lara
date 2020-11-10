$(function(){
    const searchClient = algoliasearch('T8DHNBCHPS', '7cf7dc74272f561034b491c75406b746');
    const search = instantsearch({
        indexName: 'products',
        searchClient,
        routing: true,
      });
    search.addWidgets([
        instantsearch.widgets.configure({
            hitsPerPage: 5,
        }),
        instantsearch.widgets.searchBox({
            container: '#searchbox',
            placeholder: 'Search for products',
        }),

        instantsearch.widgets.hits({
            container: '#hits',
            escapeHTML: false,
            templates: {
            item(suggestion){
                var presentPrice = suggestion.price/100;
                return `
                    <div class="d-flex">
                    <img src="${window.location.origin}/storage/${suggestion.image}" alt="img"/>
                    <div>
                        <div class="hit-name">
                            ${suggestion._highlightResult.name.value}
                        </div>
                        <div class="hit-details">
                            <span>${suggestion._highlightResult.details.value}</span>
                        </div>
                        <div>$${presentPrice.toFixed(2)}</div>
                    </div>
                    </div>
                `},
            empty: 'No results',
            },
        }),

        instantsearch.widgets.pagination({
            container: '#pagination',

        }),

        instantsearch.widgets.stats({
            container: '#stats',
        }),
    ]);
    search.start();

})

