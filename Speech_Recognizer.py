import speech_recognition as sr

r = sr.Recognizer()

def highlight_differing_words(file1, position, output_path):
    with open(file1, 'r') as f1:
        content = f1.read().split()
    
    # Wrap missed words in *
    for count in position:
        content[count] = f'*{content[count]}*'
            
    mySeparator = " "
    
    content = mySeparator.join(content)

    # Write modified content to the specified output path
    with output_path as output_file:
        output_file.write(content)
        output_file.close()

# *********************************************************
# Open the two files and find the positions of missed words
def missed_words(file1, file2):
    with open(file1, 'r') as f1, open(file2, 'r') as f2:
        words1 = f1.read().split()
        words2 = f2.read().split()

    count1 = 0
    count2 = 0
    differing_words = []
    position = []

    while count1 < len(words1):
        # This if statement checks if the audio input was shorter than the text input 
        # and adds the rest of the text input as missed words
        if count2 == len(words2)-1:
            if count1 == len(words1)-1:
                break
            
            else:
                count1 += 1
                differing_words.append(words1[count1])
                position.append(count1)
            
        elif words1[count1] == words2[count2]:
            count1 += 1
            count2 += 1
            
        else:
            differing_words.append(words1[count1])
            position.append(count1)
            count1 += 1
        
    print("Differing words:")
    print(differing_words)
    
    return position
# *********************************************************

# Get input from user (what they want to memorize)
print("Enter what you want to memorize.")

mem = input()

# Create a file containing the user's input
save1 = open(r"C:\Python\myfile.txt", "w")
save1.write(mem.lower()+"\n")
save1.close()

x = 1

# Gather and translate the user's audio input to text.
while x == 1:
    try:
        with sr.Microphone() as source:
            print("Say anything!")
            r.adjust_for_ambient_noise(source, duration=1)
            audio = r.listen(source)
            text = r.recognize_google(audio)
            text = text.lower()
            
            # Save the translated text to a file
            save2 = open(r"C:\Python\myfile2.txt", "w")
            save2.write(f"{text}" + "\n")
            save2.close()
            
            print(f"Recognized text: {text}")
            
            x = 2
    
    # Exception for the case of invalid audio input
    except:
        print("Unable to recognize audio. Please try again.")
        r = sr.Recognizer()
        continue

file1 = r"C:\Python\myfile.txt"
file2 = r"C:\Python\myfile2.txt"

position = missed_words(file1, file2)
output_path = open(r"C:\Python\my_highlighted_file1.txt", "w")
highlight_differing_words(file1, position, output_path)