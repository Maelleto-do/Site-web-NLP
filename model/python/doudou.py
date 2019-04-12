#!/usr/bin/python3.5.3

import sys
import nltk

nltk.data.path.append('nltk_data')
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

    #Ouverture de la blacklist
    #On met la black list en minuscule pour éviter les problèmes de casse
    f1 = open("model/python/black_list.txt",'r', encoding='utf-8')
    text_black_list = f1.read()
    text_black_list = text_black_list.lower()

    f2 = open("model/python/sensitive_list.txt",'r', encoding='utf-8')
    text_sensitive_list = f2.read()
    text_sensitive_list = text_sensitive_list.lower()

    f3 = open("model/python/usual_list.txt",'r', encoding='utf-8')
    text_usual_list = f3.read()
    text_usual_list = text_usual_list.lower()

    #On met le texte saisit par l'utilisateur en minuscule pour éviter les problèmes de casse
    f = open("texte_test.txt",'r', encoding='utf-8')
    text = f.read()
    text = text.lower()

    text_linearized1 = filter(text)
    black_list_token = tokenizer.tokenize(text_black_list)
    sensitive_list_token = tokenizer.tokenize(text_sensitive_list)
    usual_list_token = tokenizer.tokenize(text_usual_list)
    #Intersection des deux listes pour voir s'il y a des mots en commun
    common1 = set(text_linearized1).intersection(black_list_token)

    if(len(common1) > 0) :
        return 0
    else :
        text_linearized2 = two_group(text)
        cpt=0
        for w1, w2 in text_linearized2:
            if w1 in sensitive_list_token :
                cpt = cpt + 1
            if w1 in usual_list_token :
                cpt = cpt + 1
            if w2 in sensitive_list_token :
                cpt = cpt + 1
            if w2 in usual_list_token :
                cpt = cpt + 1

            if (cpt >= 2 ) :
                return 0

            cpt = 0
        #S'il y a des mots interdits dans le message
            #Si pas de mots interdits dans le message

    return 1

exit(find_word())
