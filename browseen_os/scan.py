import os
import json
import mimetypes


import subprocess
import sys
def install_bs4():
    subprocess.check_call([sys.executable, "-m", "pip", "install", "bs4"])

try:
    from bs4 import BeautifulSoup
except:
    install_bs4()
    from bs4 import BeautifulSoup

from bs4 import BeautifulSoup


def get_metadata(path):
    # Get file name and extension
    file_name = os.path.basename(path)
    file_extension = os.path.splitext(path)[1]

    # Get last update date
    last_update = os.path.getmtime(path)

    # Get mime type
    mime_type, _ = mimetypes.guess_type(path)

    metadata = {
        'path': path,
        'file_name': file_name,
        'last_update': last_update,
        'mime_type': mime_type,
        'extension': file_extension
    }

    # Extract additional metadata from different formats
    if os.path.isfile(path) and not 'image' in mime_type and not 'audio' in mime_type and not 'video' in mime_type:
        with open(path, 'r') as file:
            content = file.read()

            if file_extension == '.html':
                soup = BeautifulSoup(content, 'html.parser')
                body_text = soup.text
            else:
                body_text = content

            metadata['first_20_words'] = ' '.join(body_text.split()[:20])

    return metadata


def save_to_jsonl(files_data, jsonl_file_path):
    with open(jsonl_file_path, 'w') as outfile:
        for entry in files_data:
            json.dump(entry, outfile)
            outfile.write('\n')


def get_files_data(directory_path):
    files_data = []
    for root, dirs, files in os.walk(directory_path):
        for file in files:
            path = os.path.join(root, file)
            file_data = get_metadata(path)
            files_data.append(file_data)
    return files_data


def main(directory_path, jsonl_file_path):
    files_data = get_files_data(directory_path)
    save_to_jsonl(files_data, jsonl_file_path)



directory_path = './'  # replace this with your directory path
jsonl_file_path = './files.jsonl'  # output jsonl file
main(directory_path, jsonl_file_path)

# pip install beautifulsoup4