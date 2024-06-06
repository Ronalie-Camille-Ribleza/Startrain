async function getData() {
    console.log(getData)
    let url = 'https://images-api.nasa.gov/search?keywords=nebula,galaxy,exoplanet&media_type=image';
    try
    {
        let res = await fetch(url);
        return await res.json();
    } catch (error)
    {
        console.log(error);
    }
}

async function getHitCount() {
    console.log(getHitCount)
    let json = null;

    try {
        let request = await fetch(`https://images-api.nasa.gov/search?keywords=nebula,galaxy,exoplanet&media_type=image`);
        json = await request.json();
    }

    catch (error) {
        console.error(error);
    }

    if (!isUndefinedOrNull(json) && !isUndefinedOrNull(json.collection))
        return json.collection.metadata.total_hits;

    return 0;
}

async function getRandomEntryFromAPI() {
    let hit = await getHitCount();
    let page = getRandomIntInclusive();
    let entries = await getEntry(page);

}

async function getEntry()
{
    let data = await getData();
    let items = data.collection.items;
    if (items.length == 0)
        return null;

    let index = getRandomIntInclusive(0, items.length - 1);
    return items[index];
}

async function generateDisplay()
{
    let entry = await getEntry();
    if (entry === null)
        return;

    let info = entry.data[0];
    let nasa_id = info.nasa_id;
    let href = `https://images-assets.nasa.gov/image/${nasa_id}/${nasa_id}~small.jpg`;
    let htmlSegment = `<div class="info">
                               <img src="${href}"/>
                               <h1>${info.title}</h1>
                               <h2>${info.date_created}</h2>
                               <p>${info.description}</p>`
    return htmlSegment;
}

function getRandomIntInclusive(min, max)
{
    const minCeiled = Math.ceil(min);
    const maxFloored = Math.floor(max);
    return Math.floor(Math.random() * (maxFloored - minCeiled + 1) + minCeiled);
}

async function buttonClick()
{
    let content = document.getElementById("content");
    content.innerHTML = await generateDisplay();
}

function logoutUser()
{
    window.location.href = 'logout.php';
}
