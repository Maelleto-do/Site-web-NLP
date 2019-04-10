#!/usr/bin/python3.5.3

import sys
import nltk
nltk.data.path.append('nltk_data')
# nltk.download('nltk_data/tokenizers/punkt')
from nltk import word_tokenize
from nltk.tokenize import TreebankWordTokenizer
from nltk.corpus import stopwords

tokenizer = TreebankWordTokenizer()
stopWords = set(stopwords.words('french'))



#Filtre les mots en enlevant les mots inutiles (conjonctions, virgules ...)
def filter(data) :
    stopWords = set(stopwords.words('french'))
    words = nltk.word_tokenize(data)
    wordsFiltered = []
 
    for w in words:
        if w not in stopWords:
            wordsFiltered.append(w)
    return wordsFiltered



#Renvoie un texte sous forme de liste de paires de most
def two_group(data) :
    tokens = nltk.word_tokenize(data)
    group = list(nltk.bigrams(tokens))

    #retourne le tokens sous forme de groupes de mots (liste de paires)
    return group


#Renvoie si le texte saisit dans le formulaire est censuré ou non
def find_word():

    #On met la black list en minuscule pour éviter les problèmes de casse
    f1 = open("model/python/black_list.txt",'rU')
    text_black_list = f1.read()
    text_black_list = text_black_list.lower()

    f2 = open("model/python/sensitive_list.txt",'rU')
    text_sensitive_list = f2.read()
    text_sensitive_list = text_sensitive_list.lower()

    #On met le texte saisit par l'utilisateur en minuscule pour éviter les problèmes de casse
    f = open("texte_test.txt",'rU', encoding='utf-8')
    text = f.read()
    text = text.lower()
    #text = unicode(s,'utf-8')
    #text = unicodedata.normalize('NFD', text).encode('ascii', 'ignore')



    text_linearized1 = filter(text)
    black_list_token = tokenizer.tokenize(text_black_list)
    sensitive_list_token = tokenizer.tokenize(text_sensitive_list)
    #Intersection des deux listes pour voir s'il y a des mots en commun
    common1 = set(text_linearized1).intersection(black_list_token)

    text_linearized2 = two_group(text)
    for w in text_linearized2 :
        print(w)
        common2 = set(w).intersection(sensitive_list_token)

    #S'il y a des mots interdits dans le message
    if ((len(common1) > 0)  or (len(common1) > 0 and len(common2) > 0)) :
        return 0

    #Si pas de mots interdits dans le message
    return 1

exit(find_word())




# def find_word():
#
#     f = open("texte_test.txt", 'rU')
#     res = nltk.word_tokenize(f)
#     for wd in res :
#         if wd == "moche":
#             return 1
#     return 0

# exit(find_word())

#
# def find_word():
#
#     f = open("texte_test.txt", 'rU')
#     for ligne in f :
#         phrase = ligne.split()
#         #print phrase
#         #print len(phrase)
#         for i in range(0,len(phrase)):
#             #print phrase[i]
#             if phrase[i] == "moche":
#                 return 1
#     return 0
#
#
#
# exit(find_word())
