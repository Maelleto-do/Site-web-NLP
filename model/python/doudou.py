#!/usr/bin/python3.5.3

import nltk
# nltk.download('nltk_data/tokenizers/punkt')
from nltk import word_tokenize
from nltk.tokenize import TreebankWordTokenizer
tokenizer = TreebankWordTokenizer()


def find_word():

    f = open("texte_test.txt",'rU', encoding='utf-8')
    text = f.read()
    text = text.lower()

    #text = unicode(s,'utf-8')
    #text = unicodedata.normalize('NFD', text).encode('ascii', 'ignore')


    f1 = open("model/python/black_list.txt",'rU')
    text_black_list = f1.read()
    text_black_list = text_black_list.lower()



    text_token = tokenizer.tokenize(text)
    black_list_token = tokenizer.tokenize(text_black_list)


    '''On compare la black list avec le texte écrit par l'utilisateur'''

    common = set(text_token).intersection(black_list_token)



    if len(common) > 0 :
        return 0





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
