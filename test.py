""" import pandas as pd
import numpy as np
import seaborn as sns
import sklearn
from sklearn.tree import DecisionTreeClassifier
from sklearn.tree import plot_tree
import matplotlib.pyplot as plt
from sklearn.metrics import confusion_matrix
from sklearn.model_selection import train_test_split
from sklearn.metrics import classification_report
from sklearn.ensemble import RandomForestClassifier
from sklearn.neighbors import KNeighborsClassifier

data = pd.read_csv("NFL-Plays-main/nfl_plays_offense_personnel.csv")
plays23 = pd.read_csv("NFL-Plays-main/nfl_23_plays_offense_personnel.csv")
print(data.columns.tolist())

data.dropna(subset=['down'], inplace=True)
data.dropna(subset=['play_type'], inplace=True)
data.dropna(subset=['score_differential'], inplace=True)
plays23.dropna(subset=['down'], inplace=True)
plays23.dropna(subset=['play_type'], inplace=True)
plays23.dropna(subset=['score_differential'], inplace=True)

plays_predictors = plays23[['yardline_100', 
                        'down', 
                       'quarter_seconds_remaining', 
                        'qtr', 
                        'ydstogo']]
X = plays_predictors
y = plays23[['play_type']]

data_predictors = data[['yardline_100', 
                        'down', 
                       'quarter_seconds_remaining', 
                        'qtr', 
                        'ydstogo',
                        'score_differential',
                        'posteam_timeouts_remaining',
                        'defteam_timeouts_remaining']]
X = data_predictors
y = data[['play_type']]

X_train, X_test, y_train, y_test = train_test_split(X, y, test_size=0.4, random_state=42)

# Create decision tree classifier
tree_clf = DecisionTreeClassifier(max_depth=45, random_state=42)

# Train the classifier on the training data
tree_clf.fit(X_train, y_train)

X_train, X_test, y_train, y_test = train_test_split(X, y, test_size=0.4, random_state=42)

# Create decision tree classifier
tree_clf_23 = DecisionTreeClassifier(max_depth=2, random_state=42)

# Train the classifier on the training data
tree_clf_23.fit(X_train, y_train)

# Plot decision tree
plt.figure(figsize=(10, 6), dpi=500)  # Adjust the figure size and DPI
plot_tree(tree_clf_23, filled=True, feature_names=X.columns, class_names=tree_clf_23.classes_)


y_pred = tree_clf.predict(X_test)


conf_matrix = confusion_matrix(y_test, y_pred)


importances = tree_clf.feature_importances_


feature_names = data_predictors.columns

# Print the feature importances
for i, importance in zip(feature_names,importances):
    print(f"Feature {i}: {importance}")

 """
for i in range(1000):
    print(i)