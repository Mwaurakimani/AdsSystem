let dateFormatter;
export default  dateFormatter = (
    dateString,
    format = {
        year: 'numeric',
        month: 'long',
        day: '2-digit',
        hour: '2-digit',
        minute: '2-digit',
        second: '2-digit'
    }) => {
    const date = new Date(dateString);

    return date.toLocaleString('en-US', format)
}

