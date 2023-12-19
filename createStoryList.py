import os
import json

def generate_story_list(directory):
    stories = []
    for filename in os.listdir(directory):
        if filename.endswith(".txt") and not filename.startswith('.'):
            name, age = filename.rsplit('.', 1)[0].split('_', 1)
            content = open(os.path.join(directory, filename), 'r', encoding='utf-8').read()
            #content remove empty line
            content = os.linesep.join([s for s in content.splitlines() if s])
            stories.append({"name": name, "age": age, "enable": True, "content": content})

    return stories

# 指定存放故事的目錄
story_dir = './Story'

# 生成故事列表
story_list = generate_story_list(story_dir)

# 將故事列表寫入 JSON 文件
with open('storyList.json', 'w', encoding='utf-8') as f:
    json.dump(story_list, f, ensure_ascii=False, indent=4)

print("storyList.json has been created.")
