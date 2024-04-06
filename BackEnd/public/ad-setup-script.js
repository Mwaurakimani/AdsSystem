let adPlacements = null
let url = 'http://localhost:8001/api/fetchAds'
let method = 'POST'

$(document).ready(async () => {
    getAdSpaces()

    let ad_request_setup = []

    adPlacements.each((index, adPlacement) => {
        ad_request_setup = [...ad_request_setup, $(adPlacement).data('placement-id')]
    })

    try {
        let {data} = await $.ajax({url, method, data: {ad_request_setup: ad_request_setup}})

        adPlacements.each((i, adPlacement) => {

            for (const entry of data)
                if (parseInt(entry.id) === $(adPlacement).data('placement-id') && entry.relevant_ad.campaign_type) bindImage(entry,adPlacement)

        })
    } catch
        (error) {
        console.log(error)
    }
})

function getAdSpaces() {
    adPlacements = $('.ad-space')
    return adPlacements.length > 0;
}

function bindImage(entry,adPlacement){
    let path = '/storage/' + entry.relevant_ad.upload.replace(/^public\//, '')
    let img = $('<img>').attr('src', 'http://localhost:8001' + path);

    img.on('click',async () => {

        entry.relevant_ad.fullPath =  window.location.href

        let resp = await $.ajax({
            url:'http://localhost:8001/api/clickResponse',
            method:'POST',
            data:entry.relevant_ad
        })

        // window.open(entry.relevant_ad.redirect_link)
    })

    $(adPlacement).append(img)
}
