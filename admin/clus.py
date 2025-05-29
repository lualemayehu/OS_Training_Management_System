# kmeans_cluster.py
import pymysql
import pandas as pd
from sklearn.cluster import KMeans

# Connect to MySQL
conn = pymysql.connect(host='localhost', user='root', password='', db='aflex_tms')
cursor = conn.cursor()

# Fetch trainee data
df = pd.read_sql("SELECT cust_id, time_spent, completion_rate FROM customer WHERE cust_type='Trainee' AND deleted='0'", conn)

# Apply K-Means clustering
kmeans = KMeans(n_clusters=3, random_state=42)
df['cluster'] = kmeans.fit_predict(df[['time_spent', 'completion_rate']])

# Save cluster back to DB
for _, row in df.iterrows():
    cursor.execute("UPDATE customer SET cluster=%s WHERE cust_id=%s", (int(row['cluster']), int(row['cust_id'])))

conn.commit()
cursor.close()
conn.close()
