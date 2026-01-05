import sys
import requests
from io import BytesIO
from PIL import Image

# Brickognize synchronous recognition script
# Usage: python recognize.py <path/to-image> [parts|minifig|set]
# Default category is 'parts'

BASE_URL = "https://api.brickognize.com/predict"

def recognize_image(image_path, category="parts"):
    """
    Laadt de afbeelding in, zet 'm om naar PNG in-memory,
    en uploadt als 'query_image' naar het juiste predict-endpoint.
    """
    url = f"{BASE_URL}/{category}"

    # 1) Open en converteer naar PNG
    img = Image.open(image_path).convert("RGBA")
    buf = BytesIO()
    img.save(buf, format="PNG")
    buf.seek(0)

    # 2) Zet in multipart-form met expliciete PNG-mimetype
    files = {
        "query_image": (
            "upload.png",
            buf,
            "image/png"
        )
    }

    # 3) POST-en en eventueel debug-output tonen
    resp = requests.post(url, files=files, timeout=30)
    if resp.status_code != 200:
        print(">>> Response content:", resp.text)
    resp.raise_for_status()
    return resp.json()

def main():
    if len(sys.argv) < 2 or len(sys.argv) > 3:
        print("Usage: python recognize.py <image_path> [parts|minifig|set]")
        sys.exit(1)

    image_path = sys.argv[1]
    category   = sys.argv[2] if len(sys.argv) == 3 else "parts"

    try:
        result = recognize_image(image_path, category)
        print("Recognition result:")
        print(result)
    except Exception as e:
        print(f"Error during recognition: {e}")
        sys.exit(1)

if __name__ == "__main__":
    main()
