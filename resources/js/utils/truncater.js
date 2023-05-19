export default function truncater(longText, maxLength) {
    if(longText.length > maxLength) {
        return longText.substring(0, maxLength) + "...";
    }

    return longText;

}