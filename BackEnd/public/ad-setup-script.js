$(document).ready(() => {
    let adPlacements = $('.ad-space')

    let ad_request_setup = []

    if (adPlacements.length <= 0) {
        return
    }

    adPlacements.each((i, adPlacement) => {
        ad_request_setup = [...ad_request_setup, $(adPlacement).data('placement-id')]
    })
    $.ajax({
        url: 'http://localhost:8001/api/fetchAds',
        method: 'POST',
        data: {
            ad_request_setup: ad_request_setup
        },
        success: (response) => {
            let responseData = response.data

            adPlacements.each((i, adPlacement) => {
                let id = $(adPlacement).data('placement-id')

                for (const entry of responseData) {
                    if (entry.id == id) {
                        let type = entry.relevant_ad.campaign_type

                        if(type){
                            let path = entry.relevant_ad.upload
                            path = '/storage/'+path.replace(/^public\//, '')

                            // Create a new image element
                            let img = $('<img>');

                            // Set the src attribute of the image element
                            img.attr('src', 'http://localhost:8001'+path);

                            $(adPlacement).append(img)
                        }
                    }
                }
            })
        },
        error: (error) => {
            console.log(error)
        }
    })
})
