// recognize.js
import fetch from "node-fetch";
import FormData from "form-data";
import fs from "fs";
import path from "path";

async function main() {
  const img = process.argv[2];
  if (!img || !fs.existsSync(img) || !fs.statSync(img).isFile()) {
    console.error("❌ Gebruik: node recognize.js <pad/naar/afbeelding>");
    process.exit(1);
  }

  const url = "https://api.brickognize.com/predict";
  const form = new FormData();
  form.append("query_image", fs.createReadStream(img), path.basename(img));

  console.log("📤 Uploaden:", img);
  const res = await fetch(url, { method: "POST", body: form });
  console.log("📡 HTTP status:", res.status);

  if (!res.ok) {
    console.error("🚨 Fout bij herkenning:", await res.text());
    process.exit(1);
  }

  const json = await res.json();
  console.log("✅ Herkenningsresultaat:\n", JSON.stringify(json, null, 2));
}

if (import.meta.url === `file://${process.argv[1]}`) main();
