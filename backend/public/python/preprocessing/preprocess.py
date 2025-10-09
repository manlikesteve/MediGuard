import os
import pandas as pd
from sklearn.preprocessing import StandardScaler, LabelEncoder
from imblearn.under_sampling import RandomUnderSampler

# -----------------------------
# Paths
# -----------------------------
BASE_DIR = os.path.dirname(os.path.abspath(__file__))
DATA_PATH = os.path.join(BASE_DIR, "../datasets/CICIDS2017_sample.csv")
OUTPUT_PATH = os.path.join(BASE_DIR, "../datasets/preprocessed.csv")

# -----------------------------
# Preprocessing Function
# -----------------------------
def preprocess_dataset():
    print(f"[INFO] Loading dataset from {DATA_PATH}...")

    # Read CSV without headers
    df = pd.read_csv(DATA_PATH, header=None)

    # Assign proper NSL-KDD style column names
    column_names = [
        "duration","protocol_type","service","flag","src_bytes","dst_bytes","land","wrong_fragment","urgent",
        "hot","num_failed_logins","logged_in","num_compromised","root_shell","su_attempted","num_root",
        "num_file_creations","num_shells","num_access_files","num_outbound_cmds","is_host_login",
        "is_guest_login","count","srv_count","serror_rate","srv_serror_rate","rerror_rate","srv_rerror_rate",
        "same_srv_rate","diff_srv_rate","srv_diff_host_rate","dst_host_count","dst_host_srv_count",
        "dst_host_same_srv_rate","dst_host_diff_srv_rate","dst_host_same_src_port_rate",
        "dst_host_srv_diff_host_rate","dst_host_serror_rate","dst_host_srv_serror_rate","dst_host_rerror_rate",
        "dst_host_srv_rerror_rate","label","difficulty"
    ]

    # Apply column names (truncate if mismatch)
    df.columns = column_names[:len(df.columns)]

    print(f"[INFO] Dataset loaded successfully. Shape: {df.shape}")

    # -----------------------------
    # Cleaning
    # -----------------------------
    print("[INFO] Cleaning data...")
    df = df.dropna()
    df = df.drop_duplicates()
    print(f"[INFO] Cleaned data. Shape after cleaning: {df.shape}")

    # -----------------------------
    # Normalize Label Column
    # -----------------------------
    if 'label' not in df.columns:
        raise KeyError("The dataset does not contain a 'label' column.")

    print(f"[INFO] Mapping labels to 'DoS' or 'Normal'...")
    df['label'] = df['label'].astype(str).str.lower()

    # Map to DoS vs Normal
    df['Label'] = df['label'].apply(
        lambda x: 'DoS' if any(term in x for term in ['neptune', 'smurf', 'back', 'teardrop', 'land', 'pod']) else 'Normal'
    )

    print(f"[INFO] Label mapping complete. Unique values: {df['Label'].unique()}")

    # -----------------------------
    # Encoding categorical columns
    # -----------------------------
    print("[INFO] Encoding categorical features...")
    cat_cols = ['protocol_type', 'service', 'flag']
    for col in cat_cols:
        if col in df.columns:
            le = LabelEncoder()
            df[col] = le.fit_transform(df[col].astype(str))
        else:
            print(f"[WARNING] Missing expected categorical column: {col}")

    # -----------------------------
    # Feature scaling
    # -----------------------------
    print("[INFO] Scaling numerical features...")
    scaler = StandardScaler()
    num_cols = df.select_dtypes(include=['float64', 'int64']).columns
    df[num_cols] = scaler.fit_transform(df[num_cols])

    # -----------------------------
    # Balancing dataset
    # -----------------------------
    print("[INFO] Balancing data using RandomUnderSampler...")
    X = df.drop(['label', 'Label'], axis=1, errors='ignore')
    y = df['Label']

    if len(y.unique()) < 2:
        print("[ERROR] Only one class found. Ensure dataset contains both DoS and Normal samples.")
        return

    rus = RandomUnderSampler(random_state=42)
    X_res, y_res = rus.fit_resample(X, y)
    df_balanced = pd.concat([X_res, y_res], axis=1)

    # -----------------------------
    # Save processed data
    # -----------------------------
    df_balanced.to_csv(OUTPUT_PATH, index=False)
    print(f"[SUCCESS] Preprocessed dataset saved to: {OUTPUT_PATH}")
    print(f"[INFO] Final shape: {df_balanced.shape}")

# -----------------------------
# Run Script
# -----------------------------
if __name__ == "__main__":
    preprocess_dataset()
